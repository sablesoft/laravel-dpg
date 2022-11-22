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
                'id' => 1,
                'game_id' => 1,
                'deck_id' => 27,
                'card_id' => 55,
                'scope_id' => 4,
                'desc' => 'The place where our hero is located. Always one card.',
                'unique_id' => 36,
                'created_at' => '2022-11-20 04:32:01',
                'updated_at' => '2022-11-20 04:32:01',
            ),
        ));
        
        
    }
}