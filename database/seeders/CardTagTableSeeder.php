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
                'card_id' => 1,
                'tag_id' => 10,
            ),
            1 => 
            array (
                'card_id' => 1,
                'tag_id' => 11,
            ),
            2 => 
            array (
                'card_id' => 2,
                'tag_id' => 11,
            ),
            3 => 
            array (
                'card_id' => 2,
                'tag_id' => 10,
            ),
            4 => 
            array (
                'card_id' => 3,
                'tag_id' => 14,
            ),
            5 => 
            array (
                'card_id' => 5,
                'tag_id' => 14,
            ),
            6 => 
            array (
                'card_id' => 9,
                'tag_id' => 14,
            ),
            7 => 
            array (
                'card_id' => 6,
                'tag_id' => 14,
            ),
            8 => 
            array (
                'card_id' => 4,
                'tag_id' => 6,
            ),
            9 => 
            array (
                'card_id' => 8,
                'tag_id' => 8,
            ),
            10 => 
            array (
                'card_id' => 7,
                'tag_id' => 8,
            ),
            11 => 
            array (
                'card_id' => 8,
                'tag_id' => 9,
            ),
            12 => 
            array (
                'card_id' => 4,
                'tag_id' => 9,
            ),
            13 => 
            array (
                'card_id' => 7,
                'tag_id' => 9,
            ),
            14 => 
            array (
                'card_id' => 9,
                'tag_id' => 18,
            ),
            15 => 
            array (
                'card_id' => 6,
                'tag_id' => 18,
            ),
            16 => 
            array (
                'card_id' => 5,
                'tag_id' => 18,
            ),
            17 => 
            array (
                'card_id' => 18,
                'tag_id' => 9,
            ),
            18 => 
            array (
                'card_id' => 25,
                'tag_id' => 9,
            ),
            19 => 
            array (
                'card_id' => 25,
                'tag_id' => 25,
            ),
            20 => 
            array (
                'card_id' => 26,
                'tag_id' => 9,
            ),
            21 => 
            array (
                'card_id' => 27,
                'tag_id' => 9,
            ),
            22 => 
            array (
                'card_id' => 28,
                'tag_id' => 9,
            ),
            23 => 
            array (
                'card_id' => 28,
                'tag_id' => 28,
            ),
            24 => 
            array (
                'card_id' => 28,
                'tag_id' => 27,
            ),
            25 => 
            array (
                'card_id' => 29,
                'tag_id' => 29,
            ),
            26 => 
            array (
                'card_id' => 29,
                'tag_id' => 30,
            ),
            27 => 
            array (
                'card_id' => 29,
                'tag_id' => 31,
            ),
            28 => 
            array (
                'card_id' => 29,
                'tag_id' => 9,
            ),
            29 => 
            array (
                'card_id' => 28,
                'tag_id' => 34,
            ),
            30 => 
            array (
                'card_id' => 27,
                'tag_id' => 35,
            ),
            31 => 
            array (
                'card_id' => 29,
                'tag_id' => 35,
            ),
            32 => 
            array (
                'card_id' => 25,
                'tag_id' => 35,
            ),
            33 => 
            array (
                'card_id' => 30,
                'tag_id' => 35,
            ),
            34 => 
            array (
                'card_id' => 30,
                'tag_id' => 36,
            ),
            35 => 
            array (
                'card_id' => 30,
                'tag_id' => 9,
            ),
            36 => 
            array (
                'card_id' => 30,
                'tag_id' => 30,
            ),
        ));
        
        
    }
}