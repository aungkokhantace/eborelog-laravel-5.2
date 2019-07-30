<?php

/**
 * Author: Aung Ko Khant
 * Date: 2019-07-30
 * Time: 02:18 PM
 */

namespace App\Repositories\Nationality;

interface NationalityRepositoryInterface
{
    public function getObjs();
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByID($id);
    public function destroy($id);
    public function getArrays();
}
