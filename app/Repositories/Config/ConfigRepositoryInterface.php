<?php

namespace App\Repositories\Config;

interface ConfigRepositoryInterface
{
    public function getDefaultUserPassword();
    public function getRolesAssignedToProjects();
}
