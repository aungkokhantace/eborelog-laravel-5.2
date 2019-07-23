<?php

namespace App\Repositories\User;

/**
 * Author: Aung Ko Khant
 * Date: 2019-07-05
 * Time: 09:32 AM
 */
interface UserRepositoryInterface
{
    public function getObjByID($id);
    public function getPermissionsByUserId($user_id);
}
