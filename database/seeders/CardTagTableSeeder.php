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
                'card_id' => 10,
                'tag_id' => 12,
            ),
            15 => 
            array (
                'card_id' => 10,
                'tag_id' => 16,
            ),
            16 => 
            array (
                'card_id' => 11,
                'tag_id' => 16,
            ),
            17 => 
            array (
                'card_id' => 11,
                'tag_id' => 13,
            ),
            18 => 
            array (
                'card_id' => 12,
                'tag_id' => 14,
            ),
            19 => 
            array (
                'card_id' => 12,
                'tag_id' => 16,
            ),
            20 => 
            array (
                'card_id' => 13,
                'tag_id' => 16,
            ),
            21 => 
            array (
                'card_id' => 13,
                'tag_id' => 8,
            ),
            22 => 
            array (
                'card_id' => 14,
                'tag_id' => 3,
            ),
            23 => 
            array (
                'card_id' => 14,
                'tag_id' => 16,
            ),
            24 => 
            array (
                'card_id' => 15,
                'tag_id' => 16,
            ),
            25 => 
            array (
                'card_id' => 15,
                'tag_id' => 7,
            ),
            26 => 
            array (
                'card_id' => 16,
                'tag_id' => 6,
            ),
            27 => 
            array (
                'card_id' => 16,
                'tag_id' => 16,
            ),
            28 => 
            array (
                'card_id' => 9,
                'tag_id' => 18,
            ),
            29 => 
            array (
                'card_id' => 6,
                'tag_id' => 18,
            ),
            30 => 
            array (
                'card_id' => 5,
                'tag_id' => 18,
            ),
            31 => 
            array (
                'card_id' => 18,
                'tag_id' => 9,
            ),
            32 => 
            array (
                'card_id' => 19,
                'tag_id' => 19,
            ),
            33 => 
            array (
                'card_id' => 19,
                'tag_id' => 20,
            ),
            34 => 
            array (
                'card_id' => 24,
                'tag_id' => 21,
            ),
            35 => 
            array (
                'card_id' => 24,
                'tag_id' => 5,
            ),
            36 => 
            array (
                'card_id' => 23,
                'tag_id' => 21,
            ),
            37 => 
            array (
                'card_id' => 23,
                'tag_id' => 24,
            ),
        ));
        
        
    }
}