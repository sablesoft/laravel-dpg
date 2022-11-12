<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DeckCardTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('deck_card')->delete();
        
        \DB::table('deck_card')->insert(array (
            0 => 
            array (
                'deck_id' => 16,
                'card_id' => 19,
                'count' => 2,
            ),
            1 => 
            array (
                'deck_id' => 16,
                'card_id' => 17,
                'count' => 2,
            ),
            2 => 
            array (
                'deck_id' => 16,
                'card_id' => 16,
                'count' => 1,
            ),
            3 => 
            array (
                'deck_id' => 16,
                'card_id' => 21,
                'count' => 1,
            ),
            4 => 
            array (
                'deck_id' => 16,
                'card_id' => 18,
                'count' => 2,
            ),
            5 => 
            array (
                'deck_id' => 16,
                'card_id' => 6,
                'count' => 3,
            ),
            6 => 
            array (
                'deck_id' => 16,
                'card_id' => 4,
                'count' => 2,
            ),
            7 => 
            array (
                'deck_id' => 16,
                'card_id' => 10,
                'count' => 10,
            ),
            8 => 
            array (
                'deck_id' => 16,
                'card_id' => 27,
                'count' => 1,
            ),
            9 => 
            array (
                'deck_id' => 15,
                'card_id' => 43,
                'count' => 1,
            ),
            10 => 
            array (
                'deck_id' => 15,
                'card_id' => 44,
                'count' => 1,
            ),
            11 => 
            array (
                'deck_id' => 11,
                'card_id' => 47,
                'count' => 1,
            ),
            12 => 
            array (
                'deck_id' => 11,
                'card_id' => 45,
                'count' => 1,
            ),
            13 => 
            array (
                'deck_id' => 11,
                'card_id' => 48,
                'count' => 1,
            ),
            14 => 
            array (
                'deck_id' => 10,
                'card_id' => 52,
                'count' => 1,
            ),
            15 => 
            array (
                'deck_id' => 10,
                'card_id' => 53,
                'count' => 1,
            ),
            16 => 
            array (
                'deck_id' => 10,
                'card_id' => 21,
                'count' => 1,
            ),
            17 => 
            array (
                'deck_id' => 8,
                'card_id' => 50,
                'count' => 1,
            ),
            18 => 
            array (
                'deck_id' => 7,
                'card_id' => 47,
                'count' => 1,
            ),
            19 => 
            array (
                'deck_id' => 7,
                'card_id' => 45,
                'count' => 1,
            ),
            20 => 
            array (
                'deck_id' => 7,
                'card_id' => 48,
                'count' => 1,
            ),
            21 => 
            array (
                'deck_id' => 6,
                'card_id' => 43,
                'count' => 1,
            ),
            22 => 
            array (
                'deck_id' => 6,
                'card_id' => 46,
                'count' => 1,
            ),
            23 => 
            array (
                'deck_id' => 6,
                'card_id' => 47,
                'count' => 1,
            ),
            24 => 
            array (
                'deck_id' => 6,
                'card_id' => 45,
                'count' => 1,
            ),
            25 => 
            array (
                'deck_id' => 6,
                'card_id' => 44,
                'count' => 1,
            ),
            26 => 
            array (
                'deck_id' => 6,
                'card_id' => 48,
                'count' => 1,
            ),
            27 => 
            array (
                'deck_id' => 5,
                'card_id' => 51,
                'count' => 1,
            ),
            28 => 
            array (
                'deck_id' => 4,
                'card_id' => 51,
                'count' => 1,
            ),
            29 => 
            array (
                'deck_id' => 3,
                'card_id' => 46,
                'count' => 1,
            ),
            30 => 
            array (
                'deck_id' => 2,
                'card_id' => 52,
                'count' => 1,
            ),
            31 => 
            array (
                'deck_id' => 2,
                'card_id' => 53,
                'count' => 1,
            ),
            32 => 
            array (
                'deck_id' => 2,
                'card_id' => 51,
                'count' => 1,
            ),
            33 => 
            array (
                'deck_id' => 2,
                'card_id' => 54,
                'count' => 1,
            ),
        ));
        
        
    }
}