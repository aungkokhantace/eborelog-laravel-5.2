<?php

use Illuminate\Database\Seeder;

class DrillingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drilling_methods')->delete();

        $records = array(
            ['id' => 1, 'name' => 'Rotary'],
        );

        DB::table('drilling_methods')->insert($records);
    }
}
