<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DeckTagTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('deck_tag')->delete();
        
        \DB::table('deck_tag')->insert(array (
            0 => 
            array (
                'deck_id' => 5,
                'tag_id' => 24,
            ),
            1 => 
            array (
                'deck_id' => 4,
                'tag_id' => 24,
            ),
            2 => 
            array (
                'deck_id' => 10,
                'tag_id' => 24,
            ),
            3 => 
            array (
                'deck_id' => 18,
                'tag_id' => 24,
            ),
        ));
        
        
    }
}