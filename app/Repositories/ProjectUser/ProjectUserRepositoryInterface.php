<?php

namespace App\Repositories\ProjectUser;

/**
 * Author: Aung Ko Khant
 * Date: 2019-08-03
 * Time: 08:45 AM
 */
interface ProjectUserRepositoryInterface
{
    public function getUserIDsByProjectID($project_id);
    public function deleteUserIDsByProjectID($project_id);
    public function softDeleteUserIDsByProjectID($project_id);
}
