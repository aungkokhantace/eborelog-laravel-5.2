<?php

/**
 * Author: Aung Ko Khant
 * Date: 2019-07-30
 * Time: 04:46 PM
 */


namespace App\Repositories\Config;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Models\Config;

class ConfigRepository implements ConfigRepositoryInterface
{
    public function getDefaultUserPassword()
    {
        $configObj = Config::whereCode('default_user_password')->first();
        $result = $configObj->value;
        return $result;
    }
}
