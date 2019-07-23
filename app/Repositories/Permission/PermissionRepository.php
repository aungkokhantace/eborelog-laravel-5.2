<?php

/**
 * Author: Aung Ko Khant
 * Date: 2019-07-04
 * Time: 01:23 PM
 */

namespace App\Repositories\Permission;

use Illuminate\Support\Facades\DB;
use App\Models\Permission;
use App\Core\ReturnMessage;
use App\Core\Utility;
use App\Log\LogCustom;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function getObjs()
    {
        $objs = Permission::all();
        return $objs;
    }

    public function getArrays()
    {
        /*
         Retrieve records as array 
         */
        $table_name = (new Permission())->getTable();
        $arr = DB::select("SELECT * FROM  $table_name WHERE deleted_at IS NULL");
        return $arr;
    }

    public function create($paramObj)
    {
        /* 
        Save the object passed in parameter 
        */

        /* initially set to internal server error, will be set to success after object is successfully saved */
        $returnObj = array();
        $returnObj['statusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        /* for logging purpose later */
        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try {
            /* add created_by and updated_by value to the object, and save */
            $tempObj = Utility::addCreatedBy($paramObj);
            $tempObj->save();

            /* set status to success and return */
            $returnObj['statusCode'] = ReturnMessage::OK;
            $returnObj['statusMessage'] = "Permission is successfully created";
            return $returnObj;
        } catch (\Exception $e) {
            /* there is an exception,
            get error message and return */
            $returnObj['statusMessage'] = $e->getMessage();
            return $returnObj;
        }
    }

    public function update($paramObj)
    {
        /* 
        Update the object passed in parameter 
        */

        /* initially set to internal server error, will be set to success after object is successfully saved */
        $returnObj = array();
        $returnObj['statusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        /* for logging purpose later */
        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try {
            /* add updated_by value to the object, and save */
            $tempObj = Utility::addUpdatedBy($paramObj);
            $tempObj->save();

            /* set status to success and return */
            $returnObj['statusCode'] = ReturnMessage::OK;
            $returnObj['statusMessage'] = "Permission is successfully updated";
            return $returnObj;
        } catch (\Exception $e) {
            /* there is an exception,
            get error message and return */
            $returnObj['statusMessage'] = $e->getMessage();
            return $returnObj;
        }
    }

    public function destroy($id)
    {
        /* 
        Destroy the object with id passed in parameter 
        */

        /* initially set to internal server error, will be set to success after object is successfully saved */
        $returnObj = array();
        $returnObj['statusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        /* for logging purpose later */
        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try {
            /* Retrieve record and add deleted_by value */
            $tempObj = Permission::findOrFail($id);

            if (!isset($tempObj)) {
                // record not found
                $returnObj['statusMessage'] = "The requested record is not found";
            } else {
                //add deleted_by value
                $tempObj = Utility::addDeletedBy($tempObj);
                $tempObj->save();
            }

            /*  Then, softdelete the record and store the delete result */
            $delete_result = Permission::destroy($id);

            if ($delete_result > 0) {
                /* if delete_result is greater than 0, this means record is deleted,
                set statusCode to success, and return */
                $returnObj['statusCode'] = ReturnMessage::OK;
                $returnObj['statusMessage'] = "Permission is successfully deleted";
                return $returnObj;
            } else {
                /* Record is not deleted,
                return with above-predefined INTERNAL_SERVER_ERROR */
                $returnObj['statusMessage'] = "Permission is not deleted";
                return $returnObj;
            }
        } catch (\Exception $e) {
            /* If there is an exception, 
            get the error message and return */
            $returnObj['statusMessage'] = $e->getMessage();
            return $returnObj;
        }
    }

    public function getObjByID($id)
    {
        /* retrieve an object by its id */
        $result = Permission::findOrFail($id);
        return $result;
    }

    public static function getPermissionsByRoleId($role_id)
    {
        /* get available permissions for the given role */
        $role_permissions = DB::table('role_permissions')
            ->where('role_id', '=', $role_id)
            ->get();

        $result = array();

        if (count($role_permissions) > 0) {

            $countPermission = 0;

            foreach ($role_permissions as $role_permission) {
                $permission = Permission::where('id', '=', $role_permission->permission_id)
                    ->whereNull('deleted_at')->firstOrFail()->toArray();

                $result[$countPermission] = $permission;
                $countPermission++;
            }

            return $result;
        } else {
            return null;
        }
    }
}
