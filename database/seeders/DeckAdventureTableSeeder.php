<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DeckAdventureTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('deck_adventure')->delete();
        
        \DB::table('deck_adventure')->insert(array (
            0 => 
            array (
                'deck_id' => 1,
                'adventure_id' => 1,
            ),
            1 => 
            array (
                'deck_id' => 2,
                'adventure_id' => 1,
            ),
        ));
        
        
    }
}