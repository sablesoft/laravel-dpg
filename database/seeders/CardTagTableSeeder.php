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
                'tag_id' => 10,
                'card_id' => 1,
            ),
            1 => 
            array (
                'tag_id' => 11,
                'card_id' => 1,
            ),
            2 => 
            array (
                'tag_id' => 11,
                'card_id' => 2,
            ),
            3 => 
            array (
                'tag_id' => 10,
                'card_id' => 2,
            ),
            4 => 
            array (
                'tag_id' => 14,
                'card_id' => 3,
            ),
            5 => 
            array (
                'tag_id' => 14,
                'card_id' => 5,
            ),
            6 => 
            array (
                'tag_id' => 14,
                'card_id' => 9,
            ),
            7 => 
            array (
                'tag_id' => 14,
                'card_id' => 6,
            ),
            8 => 
            array (
                'tag_id' => 6,
                'card_id' => 4,
            ),
            9 => 
            array (
                'tag_id' => 8,
                'card_id' => 8,
            ),
            10 => 
            array (
                'tag_id' => 8,
                'card_id' => 7,
            ),
            11 => 
            array (
                'tag_id' => 9,
                'card_id' => 8,
            ),
            12 => 
            array (
                'tag_id' => 9,
                'card_id' => 4,
            ),
            13 => 
            array (
                'tag_id' => 9,
                'card_id' => 7,
            ),
            14 => 
            array (
                'tag_id' => 12,
                'card_id' => 10,
            ),
            15 => 
            array (
                'tag_id' => 16,
                'card_id' => 10,
            ),
            16 => 
            array (
                'tag_id' => 16,
                'card_id' => 11,
            ),
            17 => 
            array (
                'tag_id' => 13,
                'card_id' => 11,
            ),
            18 => 
            array (
                'tag_id' => 14,
                'card_id' => 12,
            ),
            19 => 
            array (
                'tag_id' => 16,
                'card_id' => 12,
            ),
            20 => 
            array (
                'tag_id' => 16,
                'card_id' => 13,
            ),
            21 => 
            array (
                'tag_id' => 8,
                'card_id' => 13,
            ),
            22 => 
            array (
                'tag_id' => 3,
                'card_id' => 14,
            ),
            23 => 
            array (
                'tag_id' => 16,
                'card_id' => 14,
            ),
            24 => 
            array (
                'tag_id' => 16,
                'card_id' => 15,
            ),
            25 => 
            array (
                'tag_id' => 7,
                'card_id' => 15,
            ),
            26 => 
            array (
                'tag_id' => 6,
                'card_id' => 16,
            ),
            27 => 
            array (
                'tag_id' => 16,
                'card_id' => 16,
            ),
            28 => 
            array (
                'tag_id' => 18,
                'card_id' => 9,
            ),
            29 => 
            array (
                'tag_id' => 18,
                'card_id' => 6,
            ),
            30 => 
            array (
                'tag_id' => 18,
                'card_id' => 5,
            ),
            31 => 
            array (
                'tag_id' => 9,
                'card_id' => 18,
            ),
            32 => 
            array (
                'tag_id' => 19,
                'card_id' => 19,
            ),
            33 => 
            array (
                'tag_id' => 20,
                'card_id' => 19,
            ),
        ));
        
        
    }
}