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
                'deck_id' => 1,
                'card_id' => 10,
                'count' => 2,
            ),
            1 => 
            array (
                'deck_id' => 1,
                'card_id' => 16,
                'count' => 2,
            ),
            2 => 
            array (
                'deck_id' => 1,
                'card_id' => 14,
                'count' => 1,
            ),
            3 => 
            array (
                'deck_id' => 1,
                'card_id' => 23,
                'count' => 3,
            ),
            4 => 
            array (
                'deck_id' => 1,
                'card_id' => 24,
                'count' => 2,
            ),
            5 => 
            array (
                'deck_id' => 1,
                'card_id' => 12,
                'count' => 1,
            ),
            6 => 
            array (
                'deck_id' => 1,
                'card_id' => 15,
                'count' => 2,
            ),
            7 => 
            array (
                'deck_id' => 1,
                'card_id' => 11,
                'count' => 2,
            ),
            8 => 
            array (
                'deck_id' => 1,
                'card_id' => 19,
                'count' => 10,
            ),
            9 => 
            array (
                'deck_id' => 1,
                'card_id' => 13,
                'count' => 1,
            ),
            10 => 
            array (
                'deck_id' => 2,
                'card_id' => 9,
                'count' => 1,
            ),
            11 => 
            array (
                'deck_id' => 2,
                'card_id' => 6,
                'count' => 1,
            ),
            12 => 
            array (
                'deck_id' => 2,
                'card_id' => 5,
                'count' => 1,
            ),
            13 => 
            array (
                'deck_id' => 3,
                'card_id' => 1,
                'count' => 1,
            ),
            14 => 
            array (
                'deck_id' => 3,
                'card_id' => 2,
                'count' => 1,
            ),
        ));
        
        
    }
}