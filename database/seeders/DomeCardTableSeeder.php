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
            4 => 
            array (
                'dome_id' => 2,
                'card_id' => 76,
            ),
            5 => 
            array (
                'dome_id' => 2,
                'card_id' => 77,
            ),
            6 => 
            array (
                'dome_id' => 2,
                'card_id' => 69,
            ),
            7 => 
            array (
                'dome_id' => 2,
                'card_id' => 51,
            ),
            8 => 
            array (
                'dome_id' => 2,
                'card_id' => 54,
            ),
            9 => 
            array (
                'dome_id' => 2,
                'card_id' => 61,
            ),
            10 => 
            array (
                'dome_id' => 2,
                'card_id' => 56,
            ),
            11 => 
            array (
                'dome_id' => 2,
                'card_id' => 53,
            ),
            12 => 
            array (
                'dome_id' => 2,
                'card_id' => 52,
            ),
            13 => 
            array (
                'dome_id' => 2,
                'card_id' => 50,
            ),
            14 => 
            array (
                'dome_id' => 2,
                'card_id' => 49,
            ),
        ));
        
        
    }
}