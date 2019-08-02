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
            // home page
            ['id' => '1', 'module' => 'Home', 'action' => 'Home Page', 'description' => 'Display home page', 'route_name' => 'home', 'method' => 'get'],

            // roles module
            ['id' => '11', 'module' => 'Role', 'action' => 'List', 'description' => 'Display role list', 'route_name' => 'roles.index', 'method' => 'get'],
            ['id' => '12', 'module' => 'Role', 'action' => 'Create', 'description' => 'Display entry form', 'route_name' => 'roles.create', 'method' => 'get'],
            ['id' => '13', 'module' => 'Role', 'action' => 'Store', 'description' => 'Store a new role', 'route_name' => 'roles.store', 'method' => 'post'],
            ['id' => '14', 'module' => 'Role', 'action' => 'Edit', 'description' => 'Display edit form', 'route_name' => 'roles.edit', 'method' => 'get'],
            ['id' => '15', 'module' => 'Role', 'action' => 'Update', 'description' => 'Update role', 'route_name' => 'roles.update', 'method' => 'put'],
            ['id' => '16', 'module' => 'Role', 'action' => 'Delete', 'description' => 'Delete role', 'route_name' => 'roles.destroy', 'method' => 'delete'],
            ['id' => '17', 'module' => 'Role', 'action' => 'Edit Permissions', 'description' => 'Edit permissions for given role', 'route_name' => 'role.edit_permissions', 'method' => 'get'],
            ['id' => '18', 'module' => 'Role', 'action' => 'Update Permissions', 'description' => 'Update permissions for given role', 'route_name' => 'role.update_permissions', 'method' => 'post'],

            // permissions module
            ['id' => '21', 'module' => 'Permission', 'action' => 'List', 'description' => 'Display permission list', 'route_name' => 'permissions.index', 'method' => 'get'],
            ['id' => '22', 'module' => 'Permission', 'action' => 'Create', 'description' => 'Display entry form', 'route_name' => 'permissions.create', 'method' => 'get'],
            ['id' => '23', 'module' => 'Permission', 'action' => 'Store', 'description' => 'Store a new permission', 'route_name' => 'permissions.store', 'method' => 'post'],
            ['id' => '24', 'module' => 'Permission', 'action' => 'Edit', 'description' => 'Display edit form', 'route_name' => 'permissions.edit', 'method' => 'get'],
            ['id' => '25', 'module' => 'Permission', 'action' => 'Update', 'description' => 'Update permission', 'route_name' => 'permissions.update', 'method' => 'put'],
            ['id' => '26', 'module' => 'Permission', 'action' => 'Delete', 'description' => 'Delete permission', 'route_name' => 'permissions.destroy', 'method' => 'delete'],

            // users module
            ['id' => '31', 'module' => 'User', 'action' => 'List', 'description' => 'Display user list', 'route_name' => 'users.index', 'method' => 'get'],
            ['id' => '32', 'module' => 'User', 'action' => 'Create', 'description' => 'Display entry form', 'route_name' => 'users.create', 'method' => 'get'],
            ['id' => '33', 'module' => 'User', 'action' => 'Store', 'description' => 'Store a new permission', 'route_name' => 'users.store', 'method' => 'post'],
            ['id' => '34', 'module' => 'User', 'action' => 'Edit', 'description' => 'Display edit form', 'route_name' => 'users.edit', 'method' => 'get'],
            ['id' => '35', 'module' => 'User', 'action' => 'Update', 'description' => 'Update user', 'route_name' => 'users.update', 'method' => 'put'],
            ['id' => '36', 'module' => 'User', 'action' => 'Delete', 'description' => 'Delete user', 'route_name' => 'users.destroy', 'method' => 'delete'],
            ['id' => '37', 'module' => 'User', 'action' => 'Show Profile', 'description' => 'Show user profile', 'route_name' => 'user.show_profile', 'method' => 'get'],
            ['id' => '38', 'module' => 'User', 'action' => 'Update Profile', 'description' => 'Update user profile', 'route_name' => 'user.update_profile', 'method' => 'put'],

            // projects module
            ['id' => '41', 'module' => 'Project', 'action' => 'List', 'description' => 'Display project list', 'route_name' => 'projects.index', 'method' => 'get'],
            ['id' => '42', 'module' => 'Project', 'action' => 'Create', 'description' => 'Display entry form', 'route_name' => 'projects.create', 'method' => 'get'],
            ['id' => '43', 'module' => 'Project', 'action' => 'Store', 'description' => 'Store a new project', 'route_name' => 'projects.store', 'method' => 'post'],
            ['id' => '44', 'module' => 'Project', 'action' => 'Edit', 'description' => 'Display edit form', 'route_name' => 'projects.edit', 'method' => 'get'],
            ['id' => '45', 'module' => 'Project', 'action' => 'Update', 'description' => 'Update project', 'route_name' => 'projects.update', 'method' => 'put'],
            ['id' => '46', 'module' => 'Project', 'action' => 'Delete', 'description' => 'Delete project', 'route_name' => 'projects.destroy', 'method' => 'delete'],
            ['id' => '47', 'module' => 'Project', 'action' => 'Detail', 'description' => 'Display project detail', 'route_name' => 'projects.show', 'method' => 'get'],

            // wo module
            ['id' => '51', 'module' => 'WO', 'action' => 'List', 'description' => 'Display WO List', 'route_name' => 'wo.index', 'method' => 'get'],

            // bore hole module
            ['id' => '61', 'module' => 'Bore_Hole', 'action' => 'List', 'description' => 'Display bore hole List', 'route_name' => 'bore_hole.index', 'method' => 'get'],
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
