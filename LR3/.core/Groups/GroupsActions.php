<?php

class GroupsActions
{
    public static function getGroupsItemsTable() : string
    {
        $groups_items = GroupsLogic::getGroupsWithParams(
            $_GET['name'] ?? null,
            $_GET['fio'] ?? null,
            $_GET['year'] ?? null,
            $_GET['major'] ?? null,
        );

        return GroupsLogic::getGroupsItemsTable($groups_items);
    }

    public static function getMajorsOptions() : string
    {
        return GroupsLogic::getMajorsOptions($_GET['major'] ?? null);
    }
}