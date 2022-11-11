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
                'book_id' => 1,
                'card_id' => 17,
                'scope_id' => 15,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-11 02:43:04',
                'updated_at' => '2022-11-11 02:43:04',
            ),
            1 => 
            array (
                'id' => 2,
                'book_id' => 1,
                'card_id' => 18,
                'scope_id' => 3,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-11 02:48:54',
                'updated_at' => '2022-11-11 02:48:54',
            ),
            2 => 
            array (
                'id' => 3,
                'book_id' => 1,
                'card_id' => 20,
                'scope_id' => 11,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-11 03:41:43',
                'updated_at' => '2022-11-11 03:41:43',
            ),
        ));
        
        
    }
}