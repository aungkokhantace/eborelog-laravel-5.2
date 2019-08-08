<?php

use Illuminate\Database\Seeder;

class DrillingRigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drilling_rigs')->delete();

        $records = array(
            ['id' => 1, 'rig_no' => 'Hanjin 1', 'model' => 'Hanjin Power 4000 SD', 'year_made' => '2009', 'lm_cert_no' => 'LM 093677N', 'noise_reduce_cylinder' => 'Yes'],
            ['id' => 2, 'rig_no' => 'Hanjin 2', 'model' => 'Hanjin D&B', 'year_made' => '2010', 'lm_cert_no' => 'LM 257893E', 'noise_reduce_cylinder' => 'Yes'],
            ['id' => 3, 'rig_no' => 'Hanjin 3', 'model' => 'Hanjin D&B - 10KD', 'year_made' => '2013', 'lm_cert_no' => 'LM 344239K', 'noise_reduce_cylinder' => 'Yes'],
            ['id' => 4, 'rig_no' => 'Hanjin 4', 'model' => 'Hanjin D&B - 10KD', 'year_made' => '2013', 'lm_cert_no' => 'LM 344240J', 'noise_reduce_cylinder' => 'Yes'],
            ['id' => 5, 'rig_no' => 'Hanjin 5', 'model' => 'Hanjin D&B - 10KD', 'year_made' => '2014', 'lm_cert_no' => 'LM 448107E', 'noise_reduce_cylinder' => 'Yes'],
            ['id' => 6, 'rig_no' => 'Hanjin 6', 'model' => 'Hanjin D&B - 10KD', 'year_made' => '2014', 'lm_cert_no' => 'LM 448108L', 'noise_reduce_cylinder' => 'Yes'],
            ['id' => 7, 'rig_no' => 'YBM 1', 'model' => 'YBM-8284', 'year_made' => '1992', 'lm_cert_no' => 'LM 080633K', 'noise_reduce_cylinder' => 'Yes'],
            ['id' => 8, 'rig_no' => 'YBM 2', 'model' => 'YBM-3JES-8338', 'year_made' => '2000', 'lm_cert_no' => 'LM 296632V', 'noise_reduce_cylinder' => 'Yes'],
            ['id' => 9, 'rig_no' => 'YBM 3', 'model' => 'YBM F001', 'year_made' => '2002', 'lm_cert_no' => 'LM 296644X', 'noise_reduce_cylinder' => 'Yes'],
            ['id' => 10, 'rig_no' => 'YBM 4', 'model' => 'YBM F002', 'year_made' => '2002', 'lm_cert_no' => 'LM 296643L', 'noise_reduce_cylinder' => 'Yes'],
            ['id' => 11, 'rig_no' => 'YBM 5', 'model' => 'YBM3JS(crawler mounted)', 'year_made' => '1995', 'lm_cert_no' => 'LM 72442C', 'noise_reduce_cylinder' => 'Yes'],
            ['id' => 12, 'rig_no' => 'D2K 1', 'model' => 'TOHO CHIKAKI 391', 'year_made' => '2002', 'lm_cert_no' => 'LM 080832K', 'noise_reduce_cylinder' => 'Yes'],
            ['id' => 13, 'rig_no' => 'D2K 3', 'model' => 'TOHO CHIKAKI 799', 'year_made' => '2002', 'lm_cert_no' => 'LM 086913P', 'noise_reduce_cylinder' => 'Yes'],
            ['id' => 14, 'rig_no' => 'PR1', 'model' => 'HYG20 Portable Rig', 'year_made' => '2013', 'lm_cert_no' => '', 'noise_reduce_cylinder' => 'Yes'],
        );

        DB::table('drilling_rigs')->insert($records);
    }
}
