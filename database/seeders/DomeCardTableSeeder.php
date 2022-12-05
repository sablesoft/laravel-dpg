<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DomeCardTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('dome_card')->delete();
        
        \DB::table('dome_card')->insert(array (
            0 => 
            array (
                'dome_id' => 2,
                'card_id' => 98,
            ),
            1 => 
            array (
                'dome_id' => 2,
                'card_id' => 100,
            ),
            2 => 
            array (
                'dome_id' => 2,
                'card_id' => 33,
            ),
            3 => 
            array (
                'dome_id' => 2,
                'card_id' => 99,
            ),
        ));
        
        
    }
}