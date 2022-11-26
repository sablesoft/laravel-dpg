<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StacksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('stacks')->delete();

        \DB::table('stacks')->insert(array (
            0 =>
            array (
                'id' => 13,
                'game_id' => 1,
                'deck_id' => 30,
                'card_id' => 35,
                'scope_id' => 13,
                'desc' => '',
                'pack' => '[20,16,19,19,7,20,19,21,19,19]',
                'discard' => '[]',
                'created_at' => '2022-11-24 19:54:09',
                'updated_at' => '2022-11-24 19:54:09',
            ),
            1 =>
            array (
                'id' => 14,
                'game_id' => 1,
                'deck_id' => 31,
                'card_id' => 35,
                'scope_id' => 19,
                'desc' => '',
                'pack' => '[77,49,77,53,54,53,50,49,61,52,51,69,56,69]',
                'discard' => '[]',
                'created_at' => '2022-11-24 19:54:09',
                'updated_at' => '2022-11-24 19:54:09',
            ),
            2 =>
            array (
                'id' => 15,
                'game_id' => 1,
                'deck_id' => 32,
                'card_id' => 35,
                'scope_id' => 20,
                'desc' => '',
                'pack' => '[76]',
                'discard' => '[]',
                'created_at' => '2022-11-24 19:54:09',
                'updated_at' => '2022-11-24 19:54:09',
            ),
            3 =>
            array (
                'id' => 16,
                'game_id' => 1,
                'deck_id' => 34,
                'card_id' => 35,
                'scope_id' => 27,
                'desc' => 'The spirits of the Rainforest are everywhere. You can communicate with them and get help from them. But be afraid to anger them!',
                'pack' => '[44,43]',
                'discard' => '[]',
                'created_at' => '2022-11-24 19:54:09',
                'updated_at' => '2022-11-24 19:54:09',
            ),
            4 =>
            array (
                'id' => 17,
                'game_id' => 1,
                'deck_id' => 25,
                'card_id' => 35,
                'scope_id' => 41,
                'desc' => '',
                'pack' => '[13,13,70,12,10,10,12,13,70,74,74,70,73,70,10,10,70,10]',
                'discard' => '[]',
                'created_at' => '2022-11-24 19:54:09',
                'updated_at' => '2022-11-24 19:54:09',
            ),
            5 =>
            array (
                'id' => 18,
                'game_id' => 1,
                'deck_id' => 11,
                'card_id' => 36,
                'scope_id' => 16,
                'desc' => '',
                'pack' => '[47,48,45]',
                'discard' => '[]',
                'created_at' => '2022-11-24 19:54:09',
                'updated_at' => '2022-11-24 19:54:09',
            ),
        ));


    }
}
