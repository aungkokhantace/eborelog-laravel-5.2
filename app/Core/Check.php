<?php

namespace App\Core;

use Validator;
use Auth;
use App\Http\Requests;
use App\Session;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class Check
{
    /* 
    create permissions session for user after successful login
    */
    public static function createSession($id)
    {
        $userRepo = new UserRepository();
        $user = $userRepo->getObjByID($id);
        $permissions = $userRepo->getPermissionsByUserId($id);
        session(['user' => $user->toArray()]);
        session(['permissions' => $permissions]);
    }

    /**
     * compare currently requested route to list of URLs defined in permissions (in session)
     * return true if the requested route is included in permission URLs
     * else, return false.. 
     **/
    public static function hasPermission($permissions, $currentAction, $request_method)
    {
        if (isset($permissions) && count($permissions) > 0) {
            foreach ($permissions as $key => $permission) {
                /* get permission's route name to compare with currentAction */
                $permission_route_name = $permission['route_name'];

                /* get method in permission object and change to upper case to compare with request_method */
                $permission_method = strtoupper($permission['method']);

                /** 
                 * if both request URL and method are same as the ones in permissions from session, return true
                 * otherwise, return false;
                 **/
                if (($permission_route_name == $currentAction) && ($permission_method == $request_method)) {
                    return true;
                }
            }
        }
        return false;
    }
}
