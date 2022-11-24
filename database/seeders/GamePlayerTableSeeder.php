<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GamePlayerTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('game_player')->delete();
        
        \DB::table('game_player')->insert(array (
            0 => 
            array (
                'game_id' => 3,
                'player_id' => 4,
            ),
        ));
        
        
    }
}