<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GameHeroTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('game_hero')->delete();
        
        \DB::table('game_hero')->insert(array (
            0 => 
            array (
                'game_id' => 1,
                'hero_id' => 80,
            ),
        ));
        
        
    }
}