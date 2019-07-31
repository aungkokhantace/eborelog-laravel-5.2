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
    public function getObjs()
    {
        $objs = User::all();
        return $objs;
    }

    public function getArrays()
    {
        /*
         Retrieve records as array 
         */
        $table_name = (new User())->getTable();
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

        try {
            /* add created_by and updated_by value to the object, and save */
            $tempObj = Utility::addCreatedBy($paramObj);
            $tempObj->save();

            /* set status to success and return */
            $returnObj['statusCode'] = ReturnMessage::OK;
            $returnObj['statusMessage'] = "User is successfully created";
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

        try {
            /* add updated_by value to the object, and save */
            $tempObj = Utility::addUpdatedBy($paramObj);
            $tempObj->save();

            /* set status to success and return */
            $returnObj['statusCode'] = ReturnMessage::OK;
            $returnObj['statusMessage'] = "User is successfully updated";
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

        try {
            /*
            If the user_id to be deleted is '1'(Super-admin), 
            Super-admin cannot be deleted.
            Set the error message and return 
            */
            if ($id == 1) {
                $returnObj['statusMessage'] = "Super-admin cannot be deleted";
                return $returnObj;
            }

            /* Retrieve record and add deleted_by value */
            $tempObj = User::findOrFail($id);

            if (!isset($tempObj)) {
                // record not found
                $returnObj['statusMessage'] = "The requested record is not found";
            } else {
                //add deleted_by value
                $tempObj = Utility::addDeletedBy($tempObj);
                $tempObj->save();
            }

            /*  Then, softdelete the record and store the delete result */
            $delete_result = User::destroy($id);

            if ($delete_result > 0) {
                /* if delete_result is greater than 0, this means record is deleted,
                set statusCode to success, and return */
                $returnObj['statusCode'] = ReturnMessage::OK;
                $returnObj['statusMessage'] = "User is successfully deleted";
                return $returnObj;
            } else {
                /* Record is not deleted,
                return with above-predefined INTERNAL_SERVER_ERROR */
                $returnObj['statusMessage'] = "User is not deleted";
                return $returnObj;
            }
        } catch (\Exception $e) {
            /* If there is an exception, 
            get the error message and return */
            $returnObj['statusMessage'] = $e->getMessage();
            return $returnObj;
        }
    }
}
