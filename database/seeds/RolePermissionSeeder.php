<?php

use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_permissions')->delete();

        $records = array(
            /* start admin permissions */
            // home page
            ['role_id' => 1, 'permission_id' => 1],

            // config
            ['role_id' => 1, 'permission_id' => 5],
            ['role_id' => 1, 'permission_id' => 6],

            // roles
            ['role_id' => 1, 'permission_id' => 11],
            ['role_id' => 1, 'permission_id' => 12],
            ['role_id' => 1, 'permission_id' => 13],
            ['role_id' => 1, 'permission_id' => 14],
            ['role_id' => 1, 'permission_id' => 15],
            ['role_id' => 1, 'permission_id' => 16],
            ['role_id' => 1, 'permission_id' => 17],
            ['role_id' => 1, 'permission_id' => 18],

            // permissions
            ['role_id' => 1, 'permission_id' => 21],
            ['role_id' => 1, 'permission_id' => 22],
            ['role_id' => 1, 'permission_id' => 23],
            ['role_id' => 1, 'permission_id' => 24],
            ['role_id' => 1, 'permission_id' => 25],
            ['role_id' => 1, 'permission_id' => 26],

            // users
            ['role_id' => 1, 'permission_id' => 31],
            ['role_id' => 1, 'permission_id' => 32],
            ['role_id' => 1, 'permission_id' => 33],
            ['role_id' => 1, 'permission_id' => 34],
            ['role_id' => 1, 'permission_id' => 35],
            ['role_id' => 1, 'permission_id' => 36],
            ['role_id' => 1, 'permission_id' => 37],
            ['role_id' => 1, 'permission_id' => 38],

            // projects
            ['role_id' => 1, 'permission_id' => 41],
            ['role_id' => 1, 'permission_id' => 42],
            ['role_id' => 1, 'permission_id' => 43],
            ['role_id' => 1, 'permission_id' => 44],
            ['role_id' => 1, 'permission_id' => 45],
            ['role_id' => 1, 'permission_id' => 46],
            ['role_id' => 1, 'permission_id' => 47],

            // WO
            ['role_id' => 1, 'permission_id' => 51],
            ['role_id' => 1, 'permission_id' => 52],
            ['role_id' => 1, 'permission_id' => 53],
            ['role_id' => 1, 'permission_id' => 54],
            ['role_id' => 1, 'permission_id' => 55],
            ['role_id' => 1, 'permission_id' => 56],
            ['role_id' => 1, 'permission_id' => 57],

            // nationality
            ['role_id' => 1, 'permission_id' => 61],
            ['role_id' => 1, 'permission_id' => 62],
            ['role_id' => 1, 'permission_id' => 63],
            ['role_id' => 1, 'permission_id' => 64],
            ['role_id' => 1, 'permission_id' => 65],
            ['role_id' => 1, 'permission_id' => 66],

            /* end admin permissions */

            /* start supervisor permissions */
            ['role_id' => 2, 'permission_id' => 1],
            ['role_id' => 2, 'permission_id' => 37],
            ['role_id' => 2, 'permission_id' => 38],

            /* end supervisor permissions */

        );

        DB::table('role_permissions')->insert($records);
    }
}
