<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function getObjByID($id);
    public function getPermissionsByUserId($user_id);
}
