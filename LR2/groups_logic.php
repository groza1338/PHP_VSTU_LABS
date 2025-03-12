<?php
$host = '127.0.0.1';
$dbname = 'LR2';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $majorStmt = $conn->query('SELECT id, name FROM majors');
    $majors = $majorStmt->fetchAll(PDO::FETCH_ASSOC);

    $min_year = $conn->query("SELECT min(year_of_entry) from groups")->fetchColumn();
    $max_year = $conn->query("SELECT max(year_of_entry) from groups")->fetchColumn();


    if (isset($_GET['clearFilter'])) {
        header('Location: groups.php');
        exit();
    }

    $whereConditions = [];
    $params = [];

    if (!empty($_GET['name'])) {
        $whereConditions[] = 'groups.name LIKE :name';
        $params[':name'] = '%' . $_GET['name'] . '%';
    }

    if (!empty($_GET['major'])) {
        $whereConditions[] = 'groups.major_id = :major';
        $params[':major'] = $_GET['major'];
    }

    if (!empty($_GET['year'])) {
        $whereConditions[] = 'groups.year_of_entry LIKE :year';
        $params[':year'] = '%' . $_GET['year'] . '%';
    }

    if (!empty($_GET['fio'])) {
        $whereConditions[] = 'groups.FIO_group LIKE :fio';
        $params[':fio'] = '%' . $_GET['fio'] . "%";
    }

    $query = 'SELECT groups.group_photo, groups.name, majors.name AS majors_name, groups.FIO_group, groups.year_of_entry FROM groups INNER JOIN majors ON groups.major_id = majors.id'
        . (!empty($whereConditions) ? ' WHERE ' . implode(' AND ', $whereConditions) : '');

    $stmt = $conn->prepare($query);
    $stmt->execute($params);

    $groupItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}