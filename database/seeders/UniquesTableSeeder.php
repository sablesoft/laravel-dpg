<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UniquesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('uniques')->delete();

        \DB::table('uniques')->insert(array (
            0 =>
            array (
                'id' => 5,
                'game_id' => 1,
                'deck_id' => 27,
                'card_id' => 55,
                'scope_id' => 85,
                'desc' => 'The place where our hero is located. Always one card.',
                'unique_id' => 36,
                'created_at' => '2022-11-24 19:54:10',
                'updated_at' => '2022-11-24 19:54:10',
            ),
            1 =>
            array (
                'id' => 6,
                'game_id' => 1,
                'deck_id' => 39,
                'card_id' => 55,
                'scope_id' => 86,
                'desc' => '',
                'unique_id' => 35,
                'created_at' => '2022-11-24 19:54:10',
                'updated_at' => '2022-11-24 19:54:10',
            ),
            2 =>
            array (
                'id' => 7,
                'game_id' => 1,
                'deck_id' => 40,
                'card_id' => 55,
                'scope_id' => 87,
                'desc' => '',
                'unique_id' => NULL,
                'created_at' => '2022-11-24 19:54:10',
                'updated_at' => '2022-11-24 19:54:10',
            ),
        ));


    }
}
