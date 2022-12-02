<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('states')->delete();

        \DB::table('states')->insert(array (
            0 =>
            array (
                'id' => 8,
                'game_id' => 1,
                'deck_id' => 27,
                'card_id' => 55,
                'scope_id' => 85,
                'owner_id' => 1,
                'desc' => 'The place where our hero is located. Always one card.',
                'state_id' => 36,
                'created_at' => '2022-12-02 02:39:46',
                'updated_at' => '2022-12-02 02:39:46',
            ),
            1 =>
            array (
                'id' => 9,
                'game_id' => 1,
                'deck_id' => 39,
                'card_id' => 55,
                'scope_id' => 86,
                'owner_id' => 1,
                'desc' => '',
                'state_id' => 35,
                'created_at' => '2022-12-02 02:39:46',
                'updated_at' => '2022-12-02 02:39:46',
            ),
            2 =>
            array (
                'id' => 10,
                'game_id' => 1,
                'deck_id' => 49,
                'card_id' => 55,
                'scope_id' => 87,
                'owner_id' => 1,
                'desc' => '',
                'state_id' => 33,
                'created_at' => '2022-12-02 02:39:46',
                'updated_at' => '2022-12-02 02:39:46',
            ),
            3 =>
            array (
                'id' => 11,
                'game_id' => 1,
                'deck_id' => 40,
                'card_id' => 55,
                'scope_id' => 90,
                'owner_id' => 1,
                'desc' => '',
                'state_id' => 89,
                'created_at' => '2022-12-02 02:39:46',
                'updated_at' => '2022-12-02 02:39:46',
            ),
        ));


    }
}
