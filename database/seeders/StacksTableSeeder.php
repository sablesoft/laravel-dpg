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
                'id' => 1,
                'game_id' => 1,
                'deck_id' => 30,
                'card_id' => 35,
                'scope_id' => 13,
                'desc' => '',
                'pack' => '[19,19,7,16,20,20,19,21,19,19]',
                'discard' => '[]',
                'created_at' => '2022-11-20 04:32:01',
                'updated_at' => '2022-11-20 04:32:01',
            ),
            1 => 
            array (
                'id' => 2,
                'game_id' => 1,
                'deck_id' => 31,
                'card_id' => 35,
                'scope_id' => 19,
                'desc' => '',
                'pack' => '[61,51,53,52,69,69,50,56,53,49,77,49,77,54]',
                'discard' => '[]',
                'created_at' => '2022-11-20 04:32:01',
                'updated_at' => '2022-11-20 04:32:01',
            ),
            2 => 
            array (
                'id' => 3,
                'game_id' => 1,
                'deck_id' => 32,
                'card_id' => 35,
                'scope_id' => 20,
                'desc' => '',
                'pack' => '[76]',
                'discard' => '[]',
                'created_at' => '2022-11-20 04:32:01',
                'updated_at' => '2022-11-20 04:32:01',
            ),
            3 => 
            array (
                'id' => 4,
                'game_id' => 1,
                'deck_id' => 34,
                'card_id' => 35,
                'scope_id' => 27,
                'desc' => 'The spirits of the Rainforest are everywhere. You can communicate with them and get help from them. But be afraid to anger them!',
                'pack' => '[43,44]',
                'discard' => '[]',
                'created_at' => '2022-11-20 04:32:01',
                'updated_at' => '2022-11-20 04:32:01',
            ),
            4 => 
            array (
                'id' => 5,
                'game_id' => 1,
                'deck_id' => 25,
                'card_id' => 35,
                'scope_id' => 41,
                'desc' => '',
                'pack' => '[74,12,70,70,10,70,10,12,74,13,73,13,13,70,10,70,10,10]',
                'discard' => '[]',
                'created_at' => '2022-11-20 04:32:01',
                'updated_at' => '2022-11-20 04:32:01',
            ),
            5 => 
            array (
                'id' => 6,
                'game_id' => 1,
                'deck_id' => 11,
                'card_id' => 36,
                'scope_id' => 16,
                'desc' => '',
                'pack' => '[48,45,47]',
                'discard' => '[]',
                'created_at' => '2022-11-20 04:32:01',
                'updated_at' => '2022-11-20 04:32:01',
            ),
        ));
        
        
    }
}