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
            3 => 
            array (
                'id' => 4,
                'book_id' => 1,
                'card_id' => 10,
                'scope_id' => 16,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 01:52:52',
                'updated_at' => '2022-11-12 01:52:52',
            ),
            4 => 
            array (
                'id' => 5,
                'book_id' => 1,
                'card_id' => 15,
                'scope_id' => 16,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 02:35:07',
                'updated_at' => '2022-11-12 02:35:07',
            ),
            5 => 
            array (
                'id' => 6,
                'book_id' => 1,
                'card_id' => 29,
                'scope_id' => 32,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 03:52:54',
                'updated_at' => '2022-11-12 03:52:54',
            ),
            6 => 
            array (
                'id' => 7,
                'book_id' => 1,
                'card_id' => 28,
                'scope_id' => 33,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 03:59:37',
                'updated_at' => '2022-11-12 03:59:37',
            ),
            7 => 
            array (
                'id' => 8,
                'book_id' => 1,
                'card_id' => 27,
                'scope_id' => 32,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 04:06:45',
                'updated_at' => '2022-11-12 04:06:45',
            ),
            8 => 
            array (
                'id' => 9,
                'book_id' => 1,
                'card_id' => 16,
                'scope_id' => 16,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 04:32:59',
                'updated_at' => '2022-11-12 04:32:59',
            ),
            9 => 
            array (
                'id' => 10,
                'book_id' => 1,
                'card_id' => 14,
                'scope_id' => 16,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 04:38:34',
                'updated_at' => '2022-11-12 04:38:34',
            ),
            10 => 
            array (
                'id' => 11,
                'book_id' => 1,
                'card_id' => 12,
                'scope_id' => 16,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 04:42:37',
                'updated_at' => '2022-11-12 04:42:37',
            ),
            11 => 
            array (
                'id' => 12,
                'book_id' => 1,
                'card_id' => 13,
                'scope_id' => 16,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 04:48:18',
                'updated_at' => '2022-11-12 04:48:18',
            ),
            12 => 
            array (
                'id' => 13,
                'book_id' => 1,
                'card_id' => 11,
                'scope_id' => 16,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 04:52:11',
                'updated_at' => '2022-11-12 04:52:11',
            ),
            13 => 
            array (
                'id' => 14,
                'book_id' => 1,
                'card_id' => 23,
                'scope_id' => 21,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 04:54:16',
                'updated_at' => '2022-11-12 04:54:16',
            ),
            14 => 
            array (
                'id' => 15,
                'book_id' => 1,
                'card_id' => 24,
                'scope_id' => 21,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 04:57:07',
                'updated_at' => '2022-11-12 04:57:07',
            ),
            15 => 
            array (
                'id' => 16,
                'book_id' => 1,
                'card_id' => 19,
                'scope_id' => 20,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 05:00:59',
                'updated_at' => '2022-11-12 05:00:59',
            ),
        ));
        
        
    }
}