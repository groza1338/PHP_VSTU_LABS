<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/LR5/.core/Database.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/LR5/.core/Groups/GroupsTable.php'); // проверь путь

class FileLogic
{
    public static function import(): ?array
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || ($_POST['action'] ?? '') !== 'import') {
            return null;
        }

        if (empty($_FILES['uploaded_file']) || !is_array($_FILES['uploaded_file'])) {
            return ['error' => 'Файл не был загружен. Выберите JSON-файл и повторите.'];
        }

        $f = $_FILES['uploaded_file'];

        if (($f['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            return ['error' => 'Ошибка загрузки файла (код ' . (int)$f['error'] . ').'];
        }
        if (!is_uploaded_file($f['tmp_name'])) {
            return ['error' => 'Неверный источник файла (ожидался загруженный пользователем файл).'];
        }

        $maxBytes = 5 * 1024 * 1024;
        if (($f['size'] ?? 0) > $maxBytes) {
            return ['error' => 'Файл слишком большой. Максимальный размер: 5 МБ.'];
        }

        $allowedMimes = [
            'application/json',
            'text/json',
            'application/x-json',
        ];
        $fi = new finfo(FILEINFO_MIME_TYPE);
        $mime = $fi->file($f['tmp_name']) ?: '';
        $ext = strtolower(pathinfo($f['name'] ?? '', PATHINFO_EXTENSION));

        if (!in_array($mime, $allowedMimes, true) || $ext !== 'json') {
            return ['error' => 'Допустим только JSON-файл (.json). Тип: ' . htmlspecialchars($mime)];
        }

        $handle = @fopen($f['tmp_name'], 'rb');
        if ($handle === false) {
            return ['error' => 'Не удалось открыть файл на чтение.'];
        }

        $buffer = '';
        try {
            while (!feof($handle)) {
                $chunk = fread($handle, 64 * 1024);
                if ($chunk === false) {
                    return ['error' => 'Ошибка чтения файла.'];
                }
                $buffer .= $chunk;

                if (strlen($buffer) > $maxBytes) {
                    return ['error' => 'Размер распакованных данных превышает лимит 5 МБ.'];
                }
            }
        } finally {
            fclose($handle);
        }

        try {
            $data = json_decode($buffer, true, flags: JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            return ['error' => 'Неверный JSON: ' . $e->getMessage()];
        }
        if (!is_array($data)) {
            return ['error' => 'Неверный формат JSON: ожидается массив записей.'];
        }

        if (self::isAssocArray($data)) {
            $data = [$data];
        }

        if (isset($data['id']) || isset($data['name']) || isset($data['FIO_group'])) {
            $data = [$data];
        }

        $rows = [];
        foreach ($data as $i => $row) {

            $allowedKeys = ['id', 'group_photo', 'name', 'FIO_group', 'major_id', 'year_of_entry'];
            if (!is_array($row) || !self::isAssocArray($row)) {
                $humanKey = is_int($i) ? "#$i" : "с ключом \"$i\"";
                $type = gettype($row);
                return ['error' =>
                    "Ошибка формата: элемент {$humanKey} имеет тип {$type}; ожидается объект (ассоциативный массив) " .
                    "со строковыми полями: " . implode(', ', $allowedKeys) . '.'
                ];
            }
            $clean = array_intersect_key($row, array_flip($allowedKeys));

            $clean['group_photo'] = self::toStrOrNull($clean['group_photo'] ?? null, 255);
            $clean['name'] = self::toStrOrNull($clean['name'] ?? null, 255);
            $clean['FIO_group'] = self::toStrOrNull($clean['FIO_group'] ?? null, 255);
            $clean['major_id'] = self::toIntOrNull($clean['major_id'] ?? null);
            $clean['year_of_entry'] = self::toYearOrNull($clean['year_of_entry'] ?? null);

            if ($clean['name'] === null && $clean['FIO_group'] === null && $clean['major_id'] === null && $clean['year_of_entry'] === null) {
                return ['error' => "Объект записи #$i не содержит данных (ожидались поля: name/FIO_group/major_id/year_of_entry)."];
            }
            $rows[] = $clean;
        }

        $pdo = Database::connection();

        try {
            $pdo->exec('DROP TABLE IF EXISTS `groups_imported`');
            $pdo->exec('CREATE TABLE `groups_imported` LIKE `groups`');

            $pdo->beginTransaction();

            $stmt = $pdo->prepare(
                'INSERT INTO `groups_imported`
            (group_photo, name, FIO_group, major_id, year_of_entry)
            VALUES
            (:group_photo, :name, :fio, :major_id, :year_of_entry)'
            );

            $inserted = 0;
            foreach ($rows as $r) {
                self::bindNullable($stmt, ':group_photo', $r['group_photo'], PDO::PARAM_STR);
                self::bindNullable($stmt, ':name', $r['name'], PDO::PARAM_STR);
                self::bindNullable($stmt, ':fio', $r['FIO_group'], PDO::PARAM_STR);
                self::bindNullable($stmt, ':major_id', $r['major_id'], PDO::PARAM_INT);
                self::bindNullable($stmt, ':year_of_entry', $r['year_of_entry'], PDO::PARAM_INT);

                $stmt->execute();
                $inserted += $stmt->rowCount();
            }

            $pdo->commit();

            $tableName = 'groups_imported';

            return [
                'data' => [
                    'table' => $tableName,
                    'count' => $inserted,
                    'message' => "Файл с данными получен и обработан. Создана таблица {$tableName} и {$inserted} записей в ней"
                ]
            ];
        } catch (Throwable $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            return ['error' => 'Ошибка импорта: ' . $e->getMessage()];
        }
    }

    /* ===================== Вспомогательное ===================== */

    private static function isAssocArray(array $arr) : bool
    {
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    private static function toStrOrNull($v, int $maxLen = 255): ?string
    {
        if ($v === null) return null;
        if (is_string($v)) {
            if ($v === '') return null;
            $s = trim($v);
            if ($s === '') return null;
            if (mb_strlen($s) > $maxLen) {
                $s = mb_substr($s, 0, $maxLen);
            }
            return $s;
        }
        return null;
    }

    private static function toIntOrNull($v): ?int
    {
        if ($v === null || $v === '') return null;
        if (is_int($v)) return $v;
        if (is_numeric($v)) return (int)$v;
        return null;
    }

    private static function toYearOrNull($v): ?int
    {
        $i = self::toIntOrNull($v);
        if ($i === null) return null;
        if ($i < 1900 || $i > 2155) return null;
        return $i;
    }

    private static function bindNullable(PDOStatement $stmt, string $param, $value, int $type): void
    {
        if ($value === null) {
            $stmt->bindValue($param, null, PDO::PARAM_NULL);
        } else {
            $stmt->bindValue($param, $value, $type);
        }
    }

    public static function export(): ?array
    {
        try {
            $rows = GroupsTable::getAllRaw();

            $json = json_encode($rows, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
            if ($json === false) {
                return ['error' => 'Не удалось сериализовать данные в JSON.'];
            }

            $table = 'groups';
            $exportBase = $table . '_exported';
            $fileName = $exportBase . '.json';
            $publicDirUrl = '/LR5/files';
            $absDir = rtrim($_SERVER['DOCUMENT_ROOT'], '/\\') . $publicDirUrl . '/';
            $absPath = $absDir . $fileName;
            $publicUrl = $publicDirUrl . '/' . $fileName;

            if (!is_dir($absDir)) {
                if (!mkdir($absDir, 0755, true) && !is_dir($absDir)) {
                    return ['error' => 'Не удалось создать директорию: ' . $publicDirUrl];
                }
            }

            $fh = @fopen($absPath, 'wb');
            if ($fh === false) {
                return ['error' => 'Не удалось открыть файл для записи: ' . $publicUrl];
            }

            try {
                if (!flock($fh, LOCK_EX)) {
                    return ['error' => 'Не удалось установить блокировку файла.'];
                }
                if (fwrite($fh, $json) === false) {
                    return ['error' => 'Ошибка записи JSON в файл.'];
                }
                fflush($fh);
                flock($fh, LOCK_UN);
            } finally {
                fclose($fh);
            }

            $anchor = sprintf(
                'href="%s" download="%s" type="application/json"',
                htmlspecialchars($publicUrl, ENT_QUOTES),
                htmlspecialchars($fileName, ENT_QUOTES)
            );

            return [
                'data' => [
                    'filename' => $fileName,
                    'saved_to' => $publicUrl,
                    'anchor_attributes' => $anchor,
                    'message' => 'Файл с данными сохранен на диск по адресу: ' . $publicUrl,
                ]
            ];
        } catch (Throwable $e) {
            return ['error' => 'Непредвиденная ошибка экспорта: ' . $e->getMessage()];
        }
    }
}
