<?php

/**
 * Author: Aung Ko Khant
 * Date: 2019-07-05
 * Time: 09:32 AM
 */

namespace App\Repositories\ProjectUser;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Core\Utility;
use App\Core\ReturnMessage;
use Auth;

class ProjectUserRepository implements ProjectUserRepositoryInterface
{
    public function getUserIDsByProjectID($project_id)
    {
        $result = User::whereIn('role_id', $project_id)->get();
        return $result;
    }
}
