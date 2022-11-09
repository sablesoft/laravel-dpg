<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagCardTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tag_card')->delete();
        
        \DB::table('tag_card')->insert(array (
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
                'card_id' => 9,
            ),
            14 => 
            array (
                'tag_id' => 9,
                'card_id' => 6,
            ),
            15 => 
            array (
                'tag_id' => 9,
                'card_id' => 7,
            ),
            16 => 
            array (
                'tag_id' => 9,
                'card_id' => 5,
            ),
            17 => 
            array (
                'tag_id' => 12,
                'card_id' => 10,
            ),
            18 => 
            array (
                'tag_id' => 16,
                'card_id' => 10,
            ),
            19 => 
            array (
                'tag_id' => 16,
                'card_id' => 11,
            ),
            20 => 
            array (
                'tag_id' => 13,
                'card_id' => 11,
            ),
            21 => 
            array (
                'tag_id' => 14,
                'card_id' => 12,
            ),
            22 => 
            array (
                'tag_id' => 16,
                'card_id' => 12,
            ),
            23 => 
            array (
                'tag_id' => 16,
                'card_id' => 13,
            ),
            24 => 
            array (
                'tag_id' => 8,
                'card_id' => 13,
            ),
            25 => 
            array (
                'tag_id' => 3,
                'card_id' => 14,
            ),
            26 => 
            array (
                'tag_id' => 16,
                'card_id' => 14,
            ),
            27 => 
            array (
                'tag_id' => 16,
                'card_id' => 15,
            ),
            28 => 
            array (
                'tag_id' => 7,
                'card_id' => 15,
            ),
            29 => 
            array (
                'tag_id' => 6,
                'card_id' => 16,
            ),
            30 => 
            array (
                'tag_id' => 16,
                'card_id' => 16,
            ),
        ));
        
        
    }
}