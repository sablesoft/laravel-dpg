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
                'deck_id' => 16,
                'tag_id' => 13,
            ),
            1 => 
            array (
                'deck_id' => 16,
                'tag_id' => 12,
            ),
            2 => 
            array (
                'deck_id' => 16,
                'tag_id' => 11,
            ),
            3 => 
            array (
                'deck_id' => 10,
                'tag_id' => 5,
            ),
            4 => 
            array (
                'deck_id' => 5,
                'tag_id' => 24,
            ),
            5 => 
            array (
                'deck_id' => 4,
                'tag_id' => 24,
            ),
        ));
        
        
    }
}