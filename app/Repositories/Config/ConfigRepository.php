<?php

namespace App\Repositories\Config;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Models\Config;

class ConfigRepository implements ConfigRepositoryInterface
{

    public function getAllConfig()
    {
        $result = Config::whereNull('deleted_at')->get();
        return $result;
    }

    public function getDefaultUserPassword()
    {
        $configObj = Config::whereCode('default_user_password')->whereType('setting')->first();

        if (isset($configObj) && count($configObj) > 0) {
            $result = $configObj->value;
        } else {
            /* if there is no default value defined in config table, then use the following as default */
            $result = "fosta@123";
        }
        return $result;
    }

    public function getRolesAssignedToProjects()
    {
        $configObj = Config::whereCode('roles_assigned_to_projects')->whereType('setting')->first();

        if (isset($configObj) && count($configObj) > 0) {
            $result = $configObj->value;
        } else {
            /* if there is no default value defined in config table, then use the following as default */
            $result = "2";
        }
        return $result;
    }
}
