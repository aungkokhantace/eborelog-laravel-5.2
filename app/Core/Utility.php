<?php

namespace App\Core;

/**
 * Author: Aung Ko Khant
 * Created Date: 2019-07-02
 * Created Time: 09:57 AM
 */

use Auth;
use File;
use App\Http\Requests;
use App\Log\LogCustom;
use InterventionImage;
//use DB;
use Illuminate\Support\Facades\DB;
//use App\Session;
use App\Core\SyncsTable\SyncsTable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Repositories\Permission\PermissionRepository;

class Utility
{

    public static function addCreatedBy($newObj)
    {
        // get currently logged in user_id
        $logged_in_user_id = Auth::id();
        if (isset($logged_in_user_id)) {
            $newObj->updated_by = $logged_in_user_id;
            $newObj->created_by = $logged_in_user_id;
        }
        // return $newObj which includes created_by and updated_by values
        return $newObj;
    }

    public static function addUpdatedBy($newObj)
    {
        // get currently logged in user_id
        $logged_in_user_id = Auth::id();
        if (isset($logged_in_user_id)) {
            $newObj->updated_by = $logged_in_user_id;
        }
        // return $newObj which includes updated_by value
        return $newObj;
    }

    public static function addDeletedBy($newObj)
    {
        // get currently logged in user_id
        $logged_in_user_id = Auth::id();
        if (isset($logged_in_user_id)) {
            $newObj->deleted_by = $logged_in_user_id;
        }
        // return $newObj which includes deleted_by value
        return $newObj;
    }

    public static function createSession($key, $value)
    {
        Session::put($key, $value);
    }

    public static function deleteSession($key)
    {
        Session::forget($key);
    }

    public static function delete_file_in_upload_folder($filename)
    {
        if (PHP_OS == "WINNT") {
            $image_path = public_path() . '\images\upload\\' . $filename;
        } else {
            $image_path = public_path() . '/images/upload/' . $filename;
        }

        if (File::exists($image_path)) {
            File::delete($image_path);
        }
    }

    public static function getCurrentUserRole()
    {
        $role_id = Auth::user()->role_id;
        return $role_id;
    }

    public static function getCurrentUser()
    {
        $user = Auth::user();
        return $user;
    }

    public static function getCurrentUserID()
    {
        $user = Auth::user();
        $id = $user->id;
        return $id;
    }

    public static function getPermissionByRoleId($role_id)
    {
        if ($role_id) {
            $permissionRepo = new PermissionRepository();
            $permissions = $permissionRepo->getPermissionsByRoleId($role_id);

            if ($permissions) {
                $permission_url_array = array();
                foreach ($permissions as $permission) {
                    array_push($permission_url_array, $permission['route_name']);
                }
                return $permission_url_array;
            }
        }
        return null;
    }
}
