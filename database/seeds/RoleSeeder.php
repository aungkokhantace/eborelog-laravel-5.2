<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('roles')->truncate();

        $records = array(
            ['id' => 1, 'name' => 'Admin', 'description' => 'Admin role can access all programs'],
        );

        DB::table('roles')->insert($records);
    }
}
