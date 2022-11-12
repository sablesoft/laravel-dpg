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
                'deck_id' => 1,
                'tag_id' => 16,
            ),
            1 => 
            array (
                'deck_id' => 1,
                'tag_id' => 21,
            ),
            2 => 
            array (
                'deck_id' => 1,
                'tag_id' => 19,
            ),
            3 => 
            array (
                'deck_id' => 6,
                'tag_id' => 34,
            ),
            4 => 
            array (
                'deck_id' => 8,
                'tag_id' => 34,
            ),
        ));
        
        
    }
}