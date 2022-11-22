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
                'name' => '{"en":"Titu\'s Quest","ru":"\\u041f\\u0440\\u0438\\u043a\\u043b\\u044e\\u0447\\u0435\\u043d\\u0438\\u044f \\u0422\\u0438\\u0442\\u0443"}',
                'desc' => '{"en":"Test my game board","ru":"\\u0422\\u0435\\u0441\\u0442\\u043e\\u0432\\u0430\\u044f \\u0438\\u0433\\u0440\\u0430, \\u0440\\u0430\\u0437\\u0440\\u0430\\u0431\\u0430\\u0442\\u044b\\u0432\\u0430\\u0435\\u043c \\u0434\\u043e\\u0441\\u043a\\u0443"}',
                'book_id' => 1,
                'hero_id' => 55,
                'quest_id' => 40,
                'master_id' => 1,
                'board_image' => '2WoLdF9xdcLwuQGXct4L44JWEophP6EIbK4zJcQh.jpg',
                'status' => 0,
                'created_at' => '2022-11-20 04:32:01',
                'updated_at' => '2022-11-22 05:11:41',
            ),
        ));
        
        
    }
}