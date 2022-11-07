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
        ));
        
        
    }
}