<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AreaSourceTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('area_source')->delete();
        
        \DB::table('area_source')->insert(array (
            0 => 
            array (
                'area_id' => 2,
                'source_id' => 2,
            ),
        ));
        
        
    }
}