<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AreaCardTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('area_card')->delete();
        
        \DB::table('area_card')->insert(array (
            0 => 
            array (
                'area_id' => 2,
                'card_id' => 36,
            ),
        ));
        
        
    }
}