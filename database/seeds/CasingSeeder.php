<?php

use Illuminate\Database\Seeder;

class CasingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('casings')->delete();

        $records = array(
            ['id' => 1, 'name' => 'NW', 'od' => '88.9'],
            ['id' => 2, 'name' => 'HW', 'od' => '114.3'],
            ['id' => 3, 'name' => 'PW', 'od' => '139.7'],
        );

        DB::table('casings')->insert($records);
    }
}
