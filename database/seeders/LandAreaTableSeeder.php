<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LandAreaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('land_area')->delete();
        
        \DB::table('land_area')->insert(array (
            0 => 
            array (
                'land_id' => 1,
                'area_id' => 2,
            ),
            1 => 
            array (
                'land_id' => 1,
                'area_id' => 1,
            ),
            2 => 
            array (
                'land_id' => 1,
                'area_id' => 3,
            ),
            3 => 
            array (
                'land_id' => 1,
                'area_id' => 4,
            ),
        ));
        
        
    }
}