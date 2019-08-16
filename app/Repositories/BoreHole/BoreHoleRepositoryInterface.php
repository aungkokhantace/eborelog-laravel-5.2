<?php

namespace App\Repositories\BoreHole;

interface BoreHoleRepositoryInterface
{
    public function getObjs();
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByID($id);
    public function destroy($id);
    public function getArrays();
    public function getObjsByProjectIdAndWOId($project_id, $wo_id);
    public function softDeleteByProjectIDAndWOId($project_id, $wo_id);
}
