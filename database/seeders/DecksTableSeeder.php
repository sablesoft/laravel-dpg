<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DecksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('decks')->delete();
        
        \DB::table('decks')->insert(array (
            0 => 
            array (
                'deck_id' => 17,
                'card_id' => 10,
                'count' => 2,
            ),
            1 => 
            array (
                'deck_id' => 17,
                'card_id' => 16,
                'count' => 2,
            ),
            2 => 
            array (
                'deck_id' => 17,
                'card_id' => 14,
                'count' => 1,
            ),
            3 => 
            array (
                'deck_id' => 17,
                'card_id' => 12,
                'count' => 1,
            ),
            4 => 
            array (
                'deck_id' => 17,
                'card_id' => 15,
                'count' => 2,
            ),
            5 => 
            array (
                'deck_id' => 17,
                'card_id' => 11,
                'count' => 2,
            ),
            6 => 
            array (
                'deck_id' => 17,
                'card_id' => 13,
                'count' => 1,
            ),
            7 => 
            array (
                'deck_id' => 18,
                'card_id' => 9,
                'count' => 1,
            ),
            8 => 
            array (
                'deck_id' => 18,
                'card_id' => 6,
                'count' => 1,
            ),
            9 => 
            array (
                'deck_id' => 18,
                'card_id' => 5,
                'count' => 1,
            ),
            10 => 
            array (
                'deck_id' => 17,
                'card_id' => 19,
                'count' => 1,
            ),
            11 => 
            array (
                'deck_id' => 16,
                'card_id' => 4,
                'count' => 1,
            ),
            12 => 
            array (
                'deck_id' => 14,
                'card_id' => 4,
                'count' => 1,
            ),
            13 => 
            array (
                'deck_id' => 14,
                'card_id' => 9,
                'count' => 1,
            ),
            14 => 
            array (
                'deck_id' => 14,
                'card_id' => 6,
                'count' => 1,
            ),
            15 => 
            array (
                'deck_id' => 14,
                'card_id' => 7,
                'count' => 1,
            ),
            16 => 
            array (
                'deck_id' => 14,
                'card_id' => 3,
                'count' => 1,
            ),
            17 => 
            array (
                'deck_id' => 14,
                'card_id' => 8,
                'count' => 1,
            ),
            18 => 
            array (
                'deck_id' => 14,
                'card_id' => 5,
                'count' => 1,
            ),
            19 => 
            array (
                'deck_id' => 12,
                'card_id' => 9,
                'count' => 1,
            ),
            20 => 
            array (
                'deck_id' => 12,
                'card_id' => 6,
                'count' => 1,
            ),
            21 => 
            array (
                'deck_id' => 12,
                'card_id' => 3,
                'count' => 1,
            ),
            22 => 
            array (
                'deck_id' => 12,
                'card_id' => 5,
                'count' => 1,
            ),
            23 => 
            array (
                'deck_id' => 20,
                'card_id' => 2,
                'count' => 1,
            ),
            24 => 
            array (
                'deck_id' => 20,
                'card_id' => 1,
                'count' => 1,
            ),
            25 => 
            array (
                'deck_id' => 21,
                'card_id' => 20,
                'count' => 1,
            ),
        ));
        
        
    }
}