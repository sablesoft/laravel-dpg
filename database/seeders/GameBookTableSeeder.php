<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GameBookTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('game_book')->delete();
        
        \DB::table('game_book')->insert(array (
            0 => 
            array (
                'game_id' => 1,
                'book_id' => 1,
            ),
        ));
        
        
    }
}