<?php

use Illuminate\Database\Seeder;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nationalities')->delete();

        $records = array(
            ['id' => 1, 'name' => 'Singaporean'],
            ['id' => 3, 'name' => 'Burmese'],
            ['id' => 2, 'name' => 'Chinese'],
            ['id' => 4, 'name' => 'Malaysian'],
            ['id' => 5, 'name' => 'Indian'],
        );

        DB::table('nationalities')->insert($records);
    }
}
