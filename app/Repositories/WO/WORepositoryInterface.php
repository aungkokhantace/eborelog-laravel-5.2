<?php

/**
 * Author: Aung Ko Khant
 * Date: 2019-08-05
 * Time: 01:52 PM
 */

namespace App\Repositories\WO;

interface WORepositoryInterface
{
    public function getObjs();
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByID($id);
    public function destroy($id);
    public function getArrays();
}
