<?php

/**
 * Author: Aung Ko Khant
 * Date: 2019-08-05
 * Time: 01:52 PM
 */


namespace App\Repositories\WO;

use Illuminate\Support\Facades\DB;
use App\Models\WO;
use App\Core\ReturnMessage;
use App\Core\Utility;
use App\Log\LogCustom;

class WORepository implements WORepositoryInterface
{
    public function getObjs()
    {
        $objs = WO::all();
        return $objs;
    }

    public function getArrays()
    {
        /*
         Retrieve records as array 
         */
        $table_name = (new WO())->getTable();
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
            $returnObj['statusMessage'] = "WO is successfully created";
            $returnObj['id'] = $tempObj->id;
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
            $returnObj['statusMessage'] = "WO is successfully updated";
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
            /* Retrieve record and add deleted_by value */
            $tempObj = WO::findOrFail($id);

            if (!isset($tempObj)) {
                // record not found
                $returnObj['statusMessage'] = "The requested record is not found";
            } else {
                //add deleted_by value
                $tempObj = Utility::addDeletedBy($tempObj);
                $tempObj->save();
            }

            /*  Then, softdelete the record and store the delete result */
            $delete_result = WO::destroy($id);

            if ($delete_result > 0) {
                /* if delete_result is greater than 0, this means record is deleted,
                set statusCode to success, and return */
                $returnObj['statusCode'] = ReturnMessage::OK;
                $returnObj['statusMessage'] = "WO is successfully deleted";
                return $returnObj;
            } else {
                /* Record is not deleted,
                return with above-predefined INTERNAL_SERVER_ERROR */
                $returnObj['statusMessage'] = "WO is not deleted";
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
        $result = WO::findOrFail($id);
        return $result;
    }

    public function getObjsByProjectID($project_id)
    {
        $result = WO::where('project_id', $project_id)->get();
        return $result;
    }

    public function softDeleteByProjectID($project_id)
    {
        $result = WO::where('project_id', $project_id)->delete();
        return $result;
    }
}
