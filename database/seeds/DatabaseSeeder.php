<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(NationalitySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DrillingCompanySeeder::class);
        $this->call(ConfigSeeder::class);
        $this->call(CasingSeeder::class);
        $this->call(DrillingMethodSeeder::class);
        $this->call(SPTMethodSeeder::class);
    }
}
