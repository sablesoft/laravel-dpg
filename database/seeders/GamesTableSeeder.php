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
                'name' => '{"en":null}',
                'desc' => '{"en":null}',
                'book_id' => 1,
                'hero_id' => 55,
                'quest_id' => 40,
                'owner_id' => 1,
                'is_public' => false,
                'board_image' => '2WoLdF9xdcLwuQGXct4L44JWEophP6EIbK4zJcQh.jpg',
                'status' => 0,
                'created_at' => '2022-11-24 19:54:09',
                'updated_at' => '2022-11-24 19:55:51',
            ),
        ));


    }
}
