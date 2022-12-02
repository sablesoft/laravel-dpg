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
                'id' => 19,
                'game_id' => 1,
                'deck_id' => 30,
                'card_id' => 35,
                'scope_id' => 13,
                'owner_id' => 1,
                'desc' => '',
                'pack' => '[19,19,20,20,7,16,19,19,21,19]',
                'discard' => '[]',
                'created_at' => '2022-12-02 02:39:45',
                'updated_at' => '2022-12-02 02:39:45',
            ),
            1 =>
            array (
                'id' => 20,
                'game_id' => 1,
                'deck_id' => 31,
                'card_id' => 35,
                'scope_id' => 19,
                'owner_id' => 1,
                'desc' => '',
                'pack' => '[69,54,51,52,50,53,49,61,56,77,69,53,77,49]',
                'discard' => '[]',
                'created_at' => '2022-12-02 02:39:45',
                'updated_at' => '2022-12-02 02:39:45',
            ),
            2 =>
            array (
                'id' => 21,
                'game_id' => 1,
                'deck_id' => 32,
                'card_id' => 35,
                'scope_id' => 20,
                'owner_id' => 1,
                'desc' => '',
                'pack' => '[76]',
                'discard' => '[]',
                'created_at' => '2022-12-02 02:39:45',
                'updated_at' => '2022-12-02 02:39:45',
            ),
            3 =>
            array (
                'id' => 22,
                'game_id' => 1,
                'deck_id' => 34,
                'card_id' => 35,
                'scope_id' => 27,
                'owner_id' => 1,
                'desc' => 'The spirits of the Rainforest are everywhere. You can communicate with them and get help from them. But be afraid to anger them!',
                'pack' => '[43,44]',
                'discard' => '[]',
                'created_at' => '2022-12-02 02:39:45',
                'updated_at' => '2022-12-02 02:39:45',
            ),
            4 =>
            array (
                'id' => 23,
                'game_id' => 1,
                'deck_id' => 25,
                'card_id' => 35,
                'scope_id' => 41,
                'owner_id' => 1,
                'desc' => '',
                'pack' => '[12,70,10,10,10,73,74,13,70,74,70,10,70,12,13,10,70,13]',
                'discard' => '[]',
                'created_at' => '2022-12-02 02:39:45',
                'updated_at' => '2022-12-02 02:39:45',
            ),
            5 =>
            array (
                'id' => 24,
                'game_id' => 1,
                'deck_id' => 11,
                'card_id' => 36,
                'scope_id' => 16,
                'owner_id' => 1,
                'desc' => '',
                'pack' => '[47,48,45]',
                'discard' => '[]',
                'created_at' => '2022-12-02 02:39:45',
                'updated_at' => '2022-12-02 02:39:45',
            ),
        ));


    }
}
