<?php
namespace LR4;
class GroupsActions
{
    public static function getGroupsItems() : ?array
    {
        return GroupsLogic::getGroupsWithParams(
            $_GET['name'] ?? null,
            $_GET['fio'] ?? null,
            $_GET['year'] ?? null,
            $_GET['major'] ?? null,
        );
    }

    public static function getMajorsOptions() : string
    {
        return GroupsLogic::getMajorsOptions($_GET['major'] ?? null);
    }
}