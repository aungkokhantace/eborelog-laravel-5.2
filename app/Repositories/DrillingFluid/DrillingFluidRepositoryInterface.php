<?php

namespace App\Repositories\DrillingFluid;

interface DrillingFluidRepositoryInterface
{
    public function getObjs();
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByID($id);
    public function destroy($id);
    public function getArrays();
}
