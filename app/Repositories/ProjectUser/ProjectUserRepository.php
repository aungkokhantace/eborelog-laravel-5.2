<?php

/**
 * Author: Aung Ko Khant
 * Date: 2019-08-03
 * Time: 08:45 AM
 */

namespace App\Repositories\ProjectUser;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Core\Utility;
use App\Core\ReturnMessage;
use Auth;
use App\Models\ProjectUser;

class ProjectUserRepository implements ProjectUserRepositoryInterface
{
    /*
    get users by project_id 
     */
    public function getUserIDsByProjectID($project_id)
    {
        $result = DB::table('project_user')
            ->where('project_id', $project_id)
            ->whereNull('deleted_at')
            ->pluck('user_id');
        return $result;
    }

    /*
    delete users by project_id
     */
    public function deleteUserIDsByProjectID($project_id)
    {
        $result = DB::table('project_user')->where('project_id', $project_id)->delete();
        return $result;
    }

    /*
    soft-delete users by project_id 
     */
    public function softDeleteUserIDsByProjectID($project_id)
    {
        $result = ProjectUser::where('project_id', $project_id)->delete();
        return $result;
    }
}
