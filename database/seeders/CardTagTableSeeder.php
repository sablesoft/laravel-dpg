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
                'card_id' => 54,
                'tag_id' => 28,
            ),
            6 => 
            array (
                'card_id' => 53,
                'tag_id' => 34,
            ),
            7 => 
            array (
                'card_id' => 53,
                'tag_id' => 30,
            ),
            8 => 
            array (
                'card_id' => 53,
                'tag_id' => 31,
            ),
            9 => 
            array (
                'card_id' => 53,
                'tag_id' => 33,
            ),
            10 => 
            array (
                'card_id' => 53,
                'tag_id' => 35,
            ),
            11 => 
            array (
                'card_id' => 53,
                'tag_id' => 32,
            ),
            12 => 
            array (
                'card_id' => 51,
                'tag_id' => 29,
            ),
            13 => 
            array (
                'card_id' => 51,
                'tag_id' => 32,
            ),
            14 => 
            array (
                'card_id' => 51,
                'tag_id' => 28,
            ),
            15 => 
            array (
                'card_id' => 51,
                'tag_id' => 24,
            ),
            16 => 
            array (
                'card_id' => 51,
                'tag_id' => 35,
            ),
            17 => 
            array (
                'card_id' => 51,
                'tag_id' => 33,
            ),
            18 => 
            array (
                'card_id' => 51,
                'tag_id' => 31,
            ),
            19 => 
            array (
                'card_id' => 51,
                'tag_id' => 30,
            ),
            20 => 
            array (
                'card_id' => 50,
                'tag_id' => 35,
            ),
            21 => 
            array (
                'card_id' => 49,
                'tag_id' => 26,
            ),
            22 => 
            array (
                'card_id' => 49,
                'tag_id' => 25,
            ),
            23 => 
            array (
                'card_id' => 49,
                'tag_id' => 35,
            ),
            24 => 
            array (
                'card_id' => 49,
                'tag_id' => 33,
            ),
            25 => 
            array (
                'card_id' => 48,
                'tag_id' => 21,
            ),
            26 => 
            array (
                'card_id' => 48,
                'tag_id' => 36,
            ),
            27 => 
            array (
                'card_id' => 47,
                'tag_id' => 21,
            ),
            28 => 
            array (
                'card_id' => 47,
                'tag_id' => 36,
            ),
            29 => 
            array (
                'card_id' => 46,
                'tag_id' => 17,
            ),
            30 => 
            array (
                'card_id' => 46,
                'tag_id' => 35,
            ),
            31 => 
            array (
                'card_id' => 45,
                'tag_id' => 21,
            ),
            32 => 
            array (
                'card_id' => 45,
                'tag_id' => 36,
            ),
            33 => 
            array (
                'card_id' => 44,
                'tag_id' => 27,
            ),
            34 => 
            array (
                'card_id' => 44,
                'tag_id' => 35,
            ),
            35 => 
            array (
                'card_id' => 43,
                'tag_id' => 27,
            ),
            36 => 
            array (
                'card_id' => 43,
                'tag_id' => 35,
            ),
            37 => 
            array (
                'card_id' => 39,
                'tag_id' => 8,
            ),
            38 => 
            array (
                'card_id' => 39,
                'tag_id' => 9,
            ),
            39 => 
            array (
                'card_id' => 38,
                'tag_id' => 9,
            ),
            40 => 
            array (
                'card_id' => 38,
                'tag_id' => 8,
            ),
        ));
        
        
    }
}