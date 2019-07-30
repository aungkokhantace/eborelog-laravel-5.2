<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $existingPermissions = DB::select('SELECT id FROM permissions');

        $permissions = array(
            ['id' => '1', 'module' => 'Home', 'action' => 'Home Page', 'description' => 'Display home page', 'route_name' => 'home', 'method' => 'get'],

            ['id' => '11', 'module' => 'Role', 'action' => 'List', 'description' => 'Display role list', 'route_name' => 'roles.index', 'method' => 'get'],
            ['id' => '12', 'module' => 'Role', 'action' => 'Create', 'description' => 'Display entry form', 'route_name' => 'roles.create', 'method' => 'get'],
            ['id' => '13', 'module' => 'Role', 'action' => 'Store', 'description' => 'Store a new role', 'route_name' => 'roles.store', 'method' => 'post'],
            ['id' => '14', 'module' => 'Role', 'action' => 'Edit', 'description' => 'Display edit form', 'route_name' => 'roles.edit', 'method' => 'get'],
            ['id' => '15', 'module' => 'Role', 'action' => 'Update', 'description' => 'Update role', 'route_name' => 'roles.update', 'method' => 'put'],
            ['id' => '16', 'module' => 'Role', 'action' => 'Delete', 'description' => 'Delete role', 'route_name' => 'roles.destroy', 'method' => 'delete'],
            ['id' => '17', 'module' => 'Role', 'action' => 'Edit Permissions', 'description' => 'Edit permissions for given role', 'route_name' => 'role.edit_permissions', 'method' => 'get'],
            ['id' => '18', 'module' => 'Role', 'action' => 'Update Permissions', 'description' => 'Update permissions for given role', 'route_name' => 'role.update_permissions', 'method' => 'post'],

            ['id' => '21', 'module' => 'Permission', 'action' => 'List', 'description' => 'Display permission list', 'route_name' => 'permissions.index', 'method' => 'get'],
            ['id' => '22', 'module' => 'Permission', 'action' => 'Create', 'description' => 'Display entry form', 'route_name' => 'permissions.create', 'method' => 'get'],
            ['id' => '23', 'module' => 'Permission', 'action' => 'Store', 'description' => 'Store a new permission', 'route_name' => 'permissions.store', 'method' => 'post'],
            ['id' => '24', 'module' => 'Permission', 'action' => 'Edit', 'description' => 'Display edit form', 'route_name' => 'permissions.edit', 'method' => 'get'],
            ['id' => '25', 'module' => 'Permission', 'action' => 'Update', 'description' => 'Update permission', 'route_name' => 'permissions.update', 'method' => 'put'],
            ['id' => '26', 'module' => 'Permission', 'action' => 'Delete', 'description' => 'Delete permission', 'route_name' => 'permissions.destroy', 'method' => 'delete'],

            ['id' => '31', 'module' => 'User', 'action' => 'List', 'description' => 'Display user list', 'route_name' => 'users.index', 'method' => 'get'],
            ['id' => '32', 'module' => 'User', 'action' => 'Create', 'description' => 'Display entry form', 'route_name' => 'users.create', 'method' => 'get'],
            ['id' => '33', 'module' => 'User', 'action' => 'Store', 'description' => 'Store a new permission', 'route_name' => 'users.store', 'method' => 'post'],
            ['id' => '34', 'module' => 'User', 'action' => 'Edit', 'description' => 'Display edit form', 'route_name' => 'users.edit', 'method' => 'get'],
            ['id' => '35', 'module' => 'User', 'action' => 'Update', 'description' => 'Update user', 'route_name' => 'users.update', 'method' => 'put'],
            ['id' => '36', 'module' => 'User', 'action' => 'Delete', 'description' => 'Delete user', 'route_name' => 'users.destroy', 'method' => 'delete'],
        );

        if (isset($existingPermissions) && count($existingPermissions) > 0) {

            $newPermissions = array();

            foreach ($permissions as $defaultPermission) {

                $existFlag = 0;
                foreach ($existingPermissions as $existPermission) {

                    if ($defaultPermission['id'] == $existPermission->id) {
                        $existFlag++;
                        break;
                    }
                }
                if ($existFlag == 0) {
                    array_push($newPermissions, $defaultPermission);
                }
            }

            if (count($newPermissions) > 0) {
                DB::table('permissions')->insert($newPermissions);
            }
        } else {
            DB::table('permissions')->insert($permissions);
        }

        echo "\n";
        echo "**********************************************";
        echo "\n";
        echo "** Finished Running Permission Seeder **";
        echo "\n";
        echo "**********************************************";
        echo "\n";
    }
}
