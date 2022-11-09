<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CardDeckTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('card_deck')->delete();
        
        \DB::table('card_deck')->insert(array (
            0 => 
            array (
                'card_id' => 2,
                'deck_id' => 1,
                'count' => 1,
            ),
            1 => 
            array (
                'card_id' => 1,
                'deck_id' => 1,
                'count' => 1,
            ),
            2 => 
            array (
                'card_id' => 8,
                'deck_id' => 2,
                'count' => 1,
            ),
            3 => 
            array (
                'card_id' => 4,
                'deck_id' => 2,
                'count' => 1,
            ),
            4 => 
            array (
                'card_id' => 9,
                'deck_id' => 2,
                'count' => 1,
            ),
            5 => 
            array (
                'card_id' => 6,
                'deck_id' => 2,
                'count' => 1,
            ),
            6 => 
            array (
                'card_id' => 7,
                'deck_id' => 2,
                'count' => 1,
            ),
            7 => 
            array (
                'card_id' => 3,
                'deck_id' => 2,
                'count' => 1,
            ),
            8 => 
            array (
                'card_id' => 5,
                'deck_id' => 2,
                'count' => 1,
            ),
            9 => 
            array (
                'card_id' => 10,
                'deck_id' => 3,
                'count' => 1,
            ),
            10 => 
            array (
                'card_id' => 16,
                'deck_id' => 3,
                'count' => 1,
            ),
            11 => 
            array (
                'card_id' => 14,
                'deck_id' => 3,
                'count' => 1,
            ),
            12 => 
            array (
                'card_id' => 12,
                'deck_id' => 3,
                'count' => 1,
            ),
            13 => 
            array (
                'card_id' => 15,
                'deck_id' => 3,
                'count' => 1,
            ),
            14 => 
            array (
                'card_id' => 11,
                'deck_id' => 3,
                'count' => 1,
            ),
            15 => 
            array (
                'card_id' => 13,
                'deck_id' => 3,
                'count' => 1,
            ),
        ));
        
        
    }
}