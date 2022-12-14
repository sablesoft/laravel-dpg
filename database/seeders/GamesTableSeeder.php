<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('games')->delete();
        
        \DB::table('games')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '{"ru":"DPG \\u0420\\u0430\\u0437\\u0440\\u0430\\u0431\\u043e\\u0442\\u043a\\u0430","en":"DPG Development"}',
                'desc' => '{"en":"Development in the process...","ru":"\\u0420\\u0430\\u0437\\u0440\\u0430\\u0431\\u043e\\u0442\\u043a\\u0430 \\u043f\\u043b\\u0430\\u0442\\u0444\\u043e\\u0440\\u043c\\u044b \\u0432 \\u043f\\u0440\\u043e\\u0446\\u0435\\u0441\\u0441\\u0435..."}',
                'image' => 'game/KQXftspceVVCMp6gK9EownutZB15Bat2uRF3g1Mw.jpg',
                'quest_id' => 40,
                'owner_id' => 1,
                'process_id' => '63aa4ce1b5ec1eb13602eded',
                'is_public' => false,
                'board_image' => 'board/2WoLdF9xdcLwuQGXct4L44JWEophP6EIbK4zJcQh.jpg',
                'cards_back' => 'back/vgsvSjrgQW3pft9mk67LYr2oCGdsqpa29u71U2GQ.png',
                'status' => 2,
                'created_at' => '2022-12-02 02:39:45',
                'updated_at' => '2022-12-27 01:39:47',
            ),
        ));
        
        
    }
}