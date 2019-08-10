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
            // start home page
            ['id' => '1', 'module' => 'Home', 'action' => 'Home Page', 'description' => 'Display home page', 'route_name' => 'home', 'method' => 'get'],

            ['id' => '5', 'module' => 'Config', 'action' => 'Edit', 'description' => 'Display config form', 'route_name' => 'config.edit', 'method' => 'get'],
            ['id' => '6', 'module' => 'Config', 'action' => 'Update', 'description' => 'Update config', 'route_name' => 'config.update', 'method' => 'post'],
            // end home page

            // start roles module
            ['id' => '11', 'module' => 'Role', 'action' => 'List', 'description' => 'Display role list', 'route_name' => 'roles.index', 'method' => 'get'],
            ['id' => '12', 'module' => 'Role', 'action' => 'Create', 'description' => 'Display entry form', 'route_name' => 'roles.create', 'method' => 'get'],
            ['id' => '13', 'module' => 'Role', 'action' => 'Store', 'description' => 'Store a new role', 'route_name' => 'roles.store', 'method' => 'post'],
            ['id' => '14', 'module' => 'Role', 'action' => 'Edit', 'description' => 'Display edit form', 'route_name' => 'roles.edit', 'method' => 'get'],
            ['id' => '15', 'module' => 'Role', 'action' => 'Update', 'description' => 'Update role', 'route_name' => 'roles.update', 'method' => 'put'],
            ['id' => '16', 'module' => 'Role', 'action' => 'Delete', 'description' => 'Delete role', 'route_name' => 'roles.destroy', 'method' => 'delete'],
            ['id' => '17', 'module' => 'Role', 'action' => 'Edit Permissions', 'description' => 'Edit permissions for given role', 'route_name' => 'role.edit_permissions', 'method' => 'get'],
            ['id' => '18', 'module' => 'Role', 'action' => 'Update Permissions', 'description' => 'Update permissions for given role', 'route_name' => 'role.update_permissions', 'method' => 'post'],
            // end roles module

            // start permissions module
            ['id' => '21', 'module' => 'Permission', 'action' => 'List', 'description' => 'Display permission list', 'route_name' => 'permissions.index', 'method' => 'get'],
            ['id' => '22', 'module' => 'Permission', 'action' => 'Create', 'description' => 'Display entry form', 'route_name' => 'permissions.create', 'method' => 'get'],
            ['id' => '23', 'module' => 'Permission', 'action' => 'Store', 'description' => 'Store a new permission', 'route_name' => 'permissions.store', 'method' => 'post'],
            ['id' => '24', 'module' => 'Permission', 'action' => 'Edit', 'description' => 'Display edit form', 'route_name' => 'permissions.edit', 'method' => 'get'],
            ['id' => '25', 'module' => 'Permission', 'action' => 'Update', 'description' => 'Update permission', 'route_name' => 'permissions.update', 'method' => 'put'],
            ['id' => '26', 'module' => 'Permission', 'action' => 'Delete', 'description' => 'Delete permission', 'route_name' => 'permissions.destroy', 'method' => 'delete'],
            // end permissions module

            // start users module
            ['id' => '31', 'module' => 'User', 'action' => 'List', 'description' => 'Display user list', 'route_name' => 'users.index', 'method' => 'get'],
            ['id' => '32', 'module' => 'User', 'action' => 'Create', 'description' => 'Display entry form', 'route_name' => 'users.create', 'method' => 'get'],
            ['id' => '33', 'module' => 'User', 'action' => 'Store', 'description' => 'Store a new permission', 'route_name' => 'users.store', 'method' => 'post'],
            ['id' => '34', 'module' => 'User', 'action' => 'Edit', 'description' => 'Display edit form', 'route_name' => 'users.edit', 'method' => 'get'],
            ['id' => '35', 'module' => 'User', 'action' => 'Update', 'description' => 'Update user', 'route_name' => 'users.update', 'method' => 'put'],
            ['id' => '36', 'module' => 'User', 'action' => 'Delete', 'description' => 'Delete user', 'route_name' => 'users.destroy', 'method' => 'delete'],
            ['id' => '37', 'module' => 'User', 'action' => 'Show Profile', 'description' => 'Show user profile', 'route_name' => 'user.show_profile', 'method' => 'get'],
            ['id' => '38', 'module' => 'User', 'action' => 'Update Profile', 'description' => 'Update user profile', 'route_name' => 'user.update_profile', 'method' => 'put'],
            // end users module

            // start projects module
            ['id' => '41', 'module' => 'Project', 'action' => 'List', 'description' => 'Display project list', 'route_name' => 'projects.index', 'method' => 'get'],
            ['id' => '42', 'module' => 'Project', 'action' => 'Create', 'description' => 'Display entry form', 'route_name' => 'projects.create', 'method' => 'get'],
            ['id' => '43', 'module' => 'Project', 'action' => 'Store', 'description' => 'Store a new project', 'route_name' => 'projects.store', 'method' => 'post'],
            ['id' => '44', 'module' => 'Project', 'action' => 'Edit', 'description' => 'Display edit form', 'route_name' => 'projects.edit', 'method' => 'get'],
            ['id' => '45', 'module' => 'Project', 'action' => 'Update', 'description' => 'Update project', 'route_name' => 'projects.update', 'method' => 'put'],
            ['id' => '46', 'module' => 'Project', 'action' => 'Delete', 'description' => 'Delete project', 'route_name' => 'projects.destroy', 'method' => 'delete'],
            ['id' => '47', 'module' => 'Project', 'action' => 'Detail', 'description' => 'Display project detail', 'route_name' => 'projects.show', 'method' => 'get'],
            // end projects module

            // start wo module
            ['id' => '51', 'module' => 'WO', 'action' => 'List', 'description' => 'Display wo list', 'route_name' => 'wo.index', 'method' => 'get'],
            ['id' => '52', 'module' => 'WO', 'action' => 'Create', 'description' => 'Display entry form', 'route_name' => 'wo.create', 'method' => 'get'],
            ['id' => '53', 'module' => 'WO', 'action' => 'Store', 'description' => 'Store a new wo', 'route_name' => 'wo.store', 'method' => 'post'],
            ['id' => '54', 'module' => 'WO', 'action' => 'Edit', 'description' => 'Display edit form', 'route_name' => 'wo.edit', 'method' => 'get'],
            ['id' => '55', 'module' => 'WO', 'action' => 'Update', 'description' => 'Update wo', 'route_name' => 'wo.update', 'method' => 'put'],
            ['id' => '56', 'module' => 'WO', 'action' => 'Delete', 'description' => 'Delete wo', 'route_name' => 'wo.destroy', 'method' => 'delete'],
            ['id' => '57', 'module' => 'WO', 'action' => 'Detail', 'description' => 'Display wo detail', 'route_name' => 'wo.show', 'method' => 'get'],
            // end wo module

            // start setups for bore hole module
            // start nationalities
            ['id' => '61', 'module' => 'Nationality', 'action' => 'List', 'description' => 'Display nationality list', 'route_name' => 'nationalities.index', 'method' => 'get'],
            ['id' => '62', 'module' => 'Nationality', 'action' => 'Create', 'description' => 'Display entry form', 'route_name' => 'nationalities.create', 'method' => 'get'],
            ['id' => '63', 'module' => 'Nationality', 'action' => 'Store', 'description' => 'Store a new nationality', 'route_name' => 'nationalities.store', 'method' => 'post'],
            ['id' => '64', 'module' => 'Nationality', 'action' => 'Edit', 'description' => 'Display edit form', 'route_name' => 'nationalities.edit', 'method' => 'get'],
            ['id' => '65', 'module' => 'Nationality', 'action' => 'Update', 'description' => 'Update nationality', 'route_name' => 'nationalities.update', 'method' => 'put'],
            ['id' => '66', 'module' => 'Nationality', 'action' => 'Delete', 'description' => 'Delete nationality', 'route_name' => 'nationalities.destroy', 'method' => 'delete'],
            // end nationalities

            // start drillers
            ['id' => '71', 'module' => 'Drillers', 'action' => 'List', 'description' => 'Display driller list', 'route_name' => 'drillers.index', 'method' => 'get'],
            ['id' => '72', 'module' => 'Drillers', 'action' => 'Create', 'description' => 'Display entry form', 'route_name' => 'drillers.create', 'method' => 'get'],
            ['id' => '73', 'module' => 'Drillers', 'action' => 'Store', 'description' => 'Store a new driller', 'route_name' => 'drillers.store', 'method' => 'post'],
            ['id' => '74', 'module' => 'Drillers', 'action' => 'Edit', 'description' => 'Display edit form', 'route_name' => 'drillers.edit', 'method' => 'get'],
            ['id' => '75', 'module' => 'Drillers', 'action' => 'Update', 'description' => 'Update driller', 'route_name' => 'drillers.update', 'method' => 'put'],
            ['id' => '76', 'module' => 'Drillers', 'action' => 'Delete', 'description' => 'Delete driller', 'route_name' => 'drillers.destroy', 'method' => 'delete'],
            // end drillers

            // start casings
            ['id' => '81', 'module' => 'Casings', 'action' => 'List', 'description' => 'Display casing list', 'route_name' => 'casings.index', 'method' => 'get'],
            ['id' => '82', 'module' => 'Casings', 'action' => 'Create', 'description' => 'Display entry form', 'route_name' => 'casings.create', 'method' => 'get'],
            ['id' => '83', 'module' => 'Casings', 'action' => 'Store', 'description' => 'Store a new casing', 'route_name' => 'casings.store', 'method' => 'post'],
            ['id' => '84', 'module' => 'Casings', 'action' => 'Edit', 'description' => 'Display edit form', 'route_name' => 'casings.edit', 'method' => 'get'],
            ['id' => '85', 'module' => 'Casings', 'action' => 'Update', 'description' => 'Update casing', 'route_name' => 'casings.update', 'method' => 'put'],
            ['id' => '86', 'module' => 'Casings', 'action' => 'Delete', 'description' => 'Delete casing', 'route_name' => 'casings.destroy', 'method' => 'delete'],
            // end casings

            // start drilling_companies
            ['id' => '91', 'module' => 'Drilling_Companies', 'action' => 'List', 'description' => 'Display drilling company list', 'route_name' => 'drilling_companies.index', 'method' => 'get'],
            ['id' => '92', 'module' => 'Drilling_Companies', 'action' => 'Create', 'description' => 'Display entry form', 'route_name' => 'drilling_companies.create', 'method' => 'get'],
            ['id' => '93', 'module' => 'Drilling_Companies', 'action' => 'Store', 'description' => 'Store a new drilling company', 'route_name' => 'drilling_companies.store', 'method' => 'post'],
            ['id' => '94', 'module' => 'Drilling_Companies', 'action' => 'Edit', 'description' => 'Display edit form', 'route_name' => 'drilling_companies.edit', 'method' => 'get'],
            ['id' => '95', 'module' => 'Drilling_Companies', 'action' => 'Update', 'description' => 'Update drilling company', 'route_name' => 'drilling_companies.update', 'method' => 'put'],
            ['id' => '96', 'module' => 'Drilling_Companies', 'action' => 'Delete', 'description' => 'Delete drilling company', 'route_name' => 'drilling_companies.destroy', 'method' => 'delete'],
            // end drilling_companies

            // start drilling_rigs
            ['id' => '101', 'module' => 'Drilling_Rigs', 'action' => 'List', 'description' => 'Display drilling rig list', 'route_name' => 'drilling_rigs.index', 'method' => 'get'],
            ['id' => '102', 'module' => 'Drilling_Rigs', 'action' => 'Create', 'description' => 'Display entry form', 'route_name' => 'drilling_rigs.create', 'method' => 'get'],
            ['id' => '103', 'module' => 'Drilling_Rigs', 'action' => 'Store', 'description' => 'Store a new drilling rig', 'route_name' => 'drilling_rigs.store', 'method' => 'post'],
            ['id' => '104', 'module' => 'Drilling_Rigs', 'action' => 'Edit', 'description' => 'Display edit form', 'route_name' => 'drilling_rigs.edit', 'method' => 'get'],
            ['id' => '105', 'module' => 'Drilling_Rigs', 'action' => 'Update', 'description' => 'Update drilling rig', 'route_name' => 'drilling_rigs.update', 'method' => 'put'],
            ['id' => '106', 'module' => 'Drilling_Rigs', 'action' => 'Delete', 'description' => 'Delete drilling rig', 'route_name' => 'drilling_rigs.destroy', 'method' => 'delete'],
            // end drilling_rigs

            // start drilling_methods
            ['id' => '111', 'module' => 'Drilling_Methods', 'action' => 'List', 'description' => 'Display drilling method list', 'route_name' => 'drilling_methods.index', 'method' => 'get'],
            ['id' => '112', 'module' => 'Drilling_Methods', 'action' => 'Create', 'description' => 'Display entry form', 'route_name' => 'drilling_methods.create', 'method' => 'get'],
            ['id' => '113', 'module' => 'Drilling_Methods', 'action' => 'Store', 'description' => 'Store a new drilling method', 'route_name' => 'drilling_methods.store', 'method' => 'post'],
            ['id' => '114', 'module' => 'Drilling_Methods', 'action' => 'Edit', 'description' => 'Display edit form', 'route_name' => 'drilling_methods.edit', 'method' => 'get'],
            ['id' => '115', 'module' => 'Drilling_Methods', 'action' => 'Update', 'description' => 'Update drilling method', 'route_name' => 'drilling_methods.update', 'method' => 'put'],
            ['id' => '116', 'module' => 'Drilling_Methods', 'action' => 'Delete', 'description' => 'Delete drilling method', 'route_name' => 'drilling_methods.destroy', 'method' => 'delete'],
            // end drilling_methods

            // end setups for bore hole module
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
