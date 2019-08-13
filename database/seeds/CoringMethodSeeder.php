<?php

use Illuminate\Database\Seeder;

class CoringMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coring_methods')->delete();

        $records = array(
            ['id' => 1, 'name' => 'NQ'],
            ['id' => 2, 'name' => 'HQ'],
            ['id' => 3, 'name' => 'NMLC'],
            ['id' => 4, 'name' => 'HMLC'],
        );

        DB::table('coring_methods')->insert($records);
    }
}
