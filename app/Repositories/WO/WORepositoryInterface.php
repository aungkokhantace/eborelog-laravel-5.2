<?php

namespace App\Repositories\WO;

interface WORepositoryInterface
{
    public function getObjs();
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByID($id);
    public function destroy($id);
    public function getArrays();
    public function getObjsByProjectID($project_id);
    public function softDeleteByProjectID($project_id);
}
