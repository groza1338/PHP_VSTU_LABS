<?php

class GroupsLogic
{
    public static function getGroupsWithParams(?string $name, ?string $fio, ?string $year_of_entry, ?string $major) : ?array
    {
        $params = [];

        if (!empty($name)) {
            $params['name'] = "%$name%";
        }

        if (!empty($fio)) {
            $params['fio'] = "%$fio%";
        }

        if (!empty($year_of_entry)) {
            $params['year_of_entry'] = $year_of_entry;
        }

        if (!empty($major)) {
            $params['major'] = $major;
        }

        return GroupsTable::getGroupsWithParams($params);
    }

    public static function getMajorsOptions($selectedMajor) : string
    {
        $html = '<option value="" ';
        $html .= '>Все направления</option>';

        $majors = GroupsTable::getMajors();

        if (!empty($majors)) {
            foreach ($majors as $major) {
                $html .= '<option value="' . $major['id'] . '" ';
                $html .= (isset($selectedMajor) && (int)$selectedMajor === $major['id']) ? ' selected' : '';
                $html .= '>' . htmlspecialchars($major['name']) . '</option>';
            }
        }

        return $html;
    }

    public static function getGroupsItemsTable($group_items) : string
    {
        if (empty($group_items)) {
            return '<tr><td colspan="5">Нет данных</td></tr>';
        }

        $html = '';

        foreach ($group_items as $group_item) {
            $html .= '<tr>';
            $html .= '<th scope="row">';
            $html .= '<img src="../.core/secure_image.php?file=' . htmlspecialchars($group_item['group_photo']) . '" alt="image" style="max-width: 200px;">';
            $html .= '</th>';
            $html .= '<td>' . $group_item['name'] . '</td>';
            $html .= '<td>' . $group_item['majors_name'] . '</td>';
            $html .= '<td>' . $group_item['FIO_group'] . '</td>';
            $html .= '<td>' . $group_item['year_of_entry'] . '</td>';
            $html .= '</tr>';
        }

        return $html;
    }

}