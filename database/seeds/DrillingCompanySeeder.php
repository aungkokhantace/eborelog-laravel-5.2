<?php

use Illuminate\Database\Seeder;

class DrillingCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drilling_companies')->delete();

        $records = array(
            ['id' => 1, 'name' => 'FOSTA'],
        );

        DB::table('drilling_companies')->insert($records);
    }
}
