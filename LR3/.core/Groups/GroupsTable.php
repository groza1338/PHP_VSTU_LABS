<?php

class GroupsTable
{
    public static function getMajors() : array
    {
        $query = Database::prepare("SELECT * FROM `majors`");
        $query->execute();
        return $query->fetchAll();
    }

    public static function getGroupsWithParams(?array $params) : ?array
    {
        $whereConditions = [];

        if (isset($params["name"])) {
            $whereConditions[] = "LOWER(groups.name) LIKE LOWER(:name)";
        }

        if (isset($params['fio'])) {
            $whereConditions[] = "LOWER(groups.FIO_group) LIKE LOWER(:fio)";
        }

        if (isset($params['year_of_entry'])) {
            $whereConditions[] = "groups.year_of_entry LIKE :year_of_entry";
        }

        if (isset($params['major'])) {
            $whereConditions[] = "groups.major_id = :major";
        }

        $query = Database::prepare('SELECT `groups`.group_photo, `groups`.name, majors.name AS majors_name, `groups`.FIO_group, `groups`.year_of_entry FROM `groups` INNER JOIN majors ON `groups`.major_id = majors.id'
            . (!empty($whereConditions) ? ' WHERE ' . implode(' AND ', $whereConditions) : ''));

        foreach ($params as $key => $value) {
            $query->bindValue(':' . $key, $value);
        }

        $query->execute();

        $groups = $query->fetchAll(PDO::FETCH_ASSOC);

        if (empty($groups)) {
            return null;
        }

        return $groups;
    }
}