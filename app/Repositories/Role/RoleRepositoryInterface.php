<?php

/**
 * Author: Aung Ko Khant
 * Date: 2019-07-01
 * Time: 06:26 PM
 */

namespace App\Repositories\Role;

interface RoleRepositoryInterface
{
    public function getObjs();
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByID($id);
    public function destroy($id);
    public function getArrays();
}
