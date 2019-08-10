<?php

use Illuminate\Database\Seeder;

class SPTMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('spt_methods')->delete();

        $records = array(
            ['id' => 1, 'name' => 'Automatic hammer'],
        );

        DB::table('spt_methods')->insert($records);
    }
}
