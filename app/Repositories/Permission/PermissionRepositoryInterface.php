<?php

/**
 * Author: Aung Ko Khant
 * Date: 2019-07-04
 * Time: 01:22 PM
 */

namespace App\Repositories\Permission;

interface PermissionRepositoryInterface
{
    public function getObjs();
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByID($id);
    public function destroy($id);
    public function getArrays();
}
