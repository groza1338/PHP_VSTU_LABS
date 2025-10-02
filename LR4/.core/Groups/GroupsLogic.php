<?php
namespace LR4;
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

}