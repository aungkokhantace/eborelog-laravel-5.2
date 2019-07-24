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
        DB::table('roles')->delete();

        $records = array(
            ['id' => 1, 'name' => 'Admin', 'description' => 'Admin role can access all programs'],
            ['id' => 2, 'name' => 'Supervisor', 'description' => 'Supervisor role can access some programs'],
        );

        DB::table('roles')->insert($records);
    }
}
