<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $records = array(
            ['id' => 1, 'name' => 'Admin', 'role_id' => 1, 'email' => 'admin@fos-ta.com', 'password' => bcrypt("admin@123"), 'phone' => '12345678', 'nric' => '12345678', 'permit_no' => '12345678', 'nationality_id' => 1, 'signature' => ''],
        );

        DB::table('users')->insert($records);
    }
}
