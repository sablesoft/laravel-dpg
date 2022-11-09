<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DecksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('decks')->delete();
        
        \DB::table('decks')->insert(array (
            0 => 
            array (
                'id' => 1,
                'scope_id' => NULL,
                'image' => NULL,
                'name' => '{"en":"Legend","ru":"Легенда"}',
                'desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-06 05:08:46',
                'updated_at' => '2022-11-06 06:48:23',
            ),
            1 => 
            array (
                'id' => 2,
                'scope_id' => NULL,
                'image' => NULL,
                'name' => '{"en":"Characters","ru":"Персонажи"}',
                'desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-08 02:22:19',
                'updated_at' => '2022-11-08 02:22:41',
            ),
        ));
        
        
    }
}