<?php

namespace App\Repositories\ProjectUser;

interface ProjectUserRepositoryInterface
{
    public function getUserIDsByProjectID($project_id);
    public function getUserIDsByProjectIDAndWoID($project_id, $wo_id);
    public function deleteUserIDsByProjectID($project_id);
    public function softDeleteUserIDsByProjectID($project_id);
    public function insertProjectUsersByArray($records_array);
}
