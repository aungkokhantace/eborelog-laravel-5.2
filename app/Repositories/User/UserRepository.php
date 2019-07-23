<?php

/**
 * Author: Aung Ko Khant
 * Date: 2019-07-05
 * Time: 09:32 AM
 */

namespace App\Repositories\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Core\Utility;
use App\Core\ReturnMessage;
use Auth;
use App\Repositories\Permission\PermissionRepository;

class UserRepository implements UserRepositoryInterface
{
    /* return user object of given ID */
    public function getObjByID($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }

    public function getPermissionsByUserId($user_id)
    {
        $role_id = Auth::user()->role_id;

        if ($role_id) {
            $permissionRepo = new PermissionRepository();
            $permissions = $permissionRepo->getPermissionsByRoleId($role_id);
            
            if ($permissions) {
                return $permissions;
            }
        }
        return null;
    }
}
