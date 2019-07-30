<?php

use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('config')->delete();

        $records = array(
            ['code' => 'default_user_password', 'type' => 'setting', 'value' => 'fosta@123', 'description' => 'Default password for creating users'],
        );

        DB::table('config')->insert($records);
    }
}
