<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CardTagTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('card_tag')->delete();
        
        \DB::table('card_tag')->insert(array (
            0 => 
            array (
                'card_id' => 55,
                'tag_id' => 21,
            ),
            1 => 
            array (
                'card_id' => 54,
                'tag_id' => 25,
            ),
            2 => 
            array (
                'card_id' => 53,
                'tag_id' => 25,
            ),
            3 => 
            array (
                'card_id' => 52,
                'tag_id' => 25,
            ),
            4 => 
            array (
                'card_id' => 52,
                'tag_id' => 35,
            ),
            5 => 
            array (
                'card_id' => 50,
                'tag_id' => 35,
            ),
            6 => 
            array (
                'card_id' => 49,
                'tag_id' => 26,
            ),
            7 => 
            array (
                'card_id' => 49,
                'tag_id' => 25,
            ),
            8 => 
            array (
                'card_id' => 48,
                'tag_id' => 21,
            ),
            9 => 
            array (
                'card_id' => 48,
                'tag_id' => 36,
            ),
            10 => 
            array (
                'card_id' => 47,
                'tag_id' => 21,
            ),
            11 => 
            array (
                'card_id' => 47,
                'tag_id' => 36,
            ),
            12 => 
            array (
                'card_id' => 46,
                'tag_id' => 17,
            ),
            13 => 
            array (
                'card_id' => 46,
                'tag_id' => 35,
            ),
            14 => 
            array (
                'card_id' => 45,
                'tag_id' => 21,
            ),
            15 => 
            array (
                'card_id' => 45,
                'tag_id' => 36,
            ),
            16 => 
            array (
                'card_id' => 44,
                'tag_id' => 27,
            ),
            17 => 
            array (
                'card_id' => 44,
                'tag_id' => 35,
            ),
            18 => 
            array (
                'card_id' => 43,
                'tag_id' => 27,
            ),
            19 => 
            array (
                'card_id' => 43,
                'tag_id' => 35,
            ),
            20 => 
            array (
                'card_id' => 39,
                'tag_id' => 8,
            ),
            21 => 
            array (
                'card_id' => 39,
                'tag_id' => 9,
            ),
            22 => 
            array (
                'card_id' => 38,
                'tag_id' => 9,
            ),
            23 => 
            array (
                'card_id' => 38,
                'tag_id' => 8,
            ),
            24 => 
            array (
                'card_id' => 56,
                'tag_id' => 35,
            ),
            25 => 
            array (
                'card_id' => 56,
                'tag_id' => 58,
            ),
            26 => 
            array (
                'card_id' => 51,
                'tag_id' => 58,
            ),
            27 => 
            array (
                'card_id' => 51,
                'tag_id' => 59,
            ),
            28 => 
            array (
                'card_id' => 54,
                'tag_id' => 58,
            ),
            29 => 
            array (
                'card_id' => 54,
                'tag_id' => 26,
            ),
            30 => 
            array (
                'card_id' => 53,
                'tag_id' => 59,
            ),
            31 => 
            array (
                'card_id' => 53,
                'tag_id' => 67,
            ),
            32 => 
            array (
                'card_id' => 77,
                'tag_id' => 78,
            ),
            33 => 
            array (
                'card_id' => 89,
                'tag_id' => 85,
            ),
            34 => 
            array (
                'card_id' => 88,
                'tag_id' => 85,
            ),
        ));
        
        
    }
}