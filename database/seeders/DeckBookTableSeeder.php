<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DeckBookTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('deck_book')->delete();
        
        \DB::table('deck_book')->insert(array (
            0 => 
            array (
                'deck_id' => 1,
                'book_id' => 1,
            ),
            1 => 
            array (
                'deck_id' => 2,
                'book_id' => 1,
            ),
            2 => 
            array (
                'deck_id' => 3,
                'book_id' => 1,
            ),
        ));
        
        
    }
}