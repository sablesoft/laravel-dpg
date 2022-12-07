<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GameSubscriberTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('game_subscriber')->delete();

        \DB::table('game_subscriber')->insert(array (
            0 =>
            array (
                'game_id' => 1,
                'subscriber_id' => 2,
                'type' => 0,
            ),
        ));


    }
}
