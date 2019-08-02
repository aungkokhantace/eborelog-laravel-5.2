<?php

/**
 * Author: Aung Ko Khant
 * Date: 2019-08-01
 * Time: 09:58 AM
 */

namespace App\Repositories\Project;

interface ProjectRepositoryInterface
{
    public function getObjs();
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByID($id);
    public function destroy($id);
    public function getArrays();
}
