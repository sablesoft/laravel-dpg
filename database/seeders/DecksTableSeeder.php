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
                'id' => 2,
                'book_id' => 1,
                'card_id' => 19,
                'scope_id' => 13,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:50:38',
                'updated_at' => '2022-11-12 16:50:38',
            ),
            1 => 
            array (
                'id' => 3,
                'book_id' => 1,
                'card_id' => 17,
                'scope_id' => 13,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:51:09',
                'updated_at' => '2022-11-12 16:51:09',
            ),
            2 => 
            array (
                'id' => 4,
                'book_id' => 1,
                'card_id' => 52,
                'scope_id' => 22,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:51:25',
                'updated_at' => '2022-11-12 16:51:25',
            ),
            3 => 
            array (
                'id' => 5,
                'book_id' => 1,
                'card_id' => 53,
                'scope_id' => 22,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:51:37',
                'updated_at' => '2022-11-12 16:51:37',
            ),
            4 => 
            array (
                'id' => 6,
                'book_id' => 1,
                'card_id' => 16,
                'scope_id' => 13,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:51:51',
                'updated_at' => '2022-11-12 16:51:51',
            ),
            5 => 
            array (
                'id' => 7,
                'book_id' => 1,
                'card_id' => 21,
                'scope_id' => 13,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:52:51',
                'updated_at' => '2022-11-12 16:52:51',
            ),
            6 => 
            array (
                'id' => 8,
                'book_id' => 1,
                'card_id' => 18,
                'scope_id' => 13,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:53:03',
                'updated_at' => '2022-11-12 16:53:03',
            ),
            7 => 
            array (
                'id' => 9,
                'book_id' => 1,
                'card_id' => 6,
                'scope_id' => 12,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:53:21',
                'updated_at' => '2022-11-12 16:53:21',
            ),
            8 => 
            array (
                'id' => 10,
                'book_id' => 1,
                'card_id' => 51,
                'scope_id' => 23,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:53:38',
                'updated_at' => '2022-11-12 16:53:38',
            ),
            9 => 
            array (
                'id' => 11,
                'book_id' => 1,
                'card_id' => 36,
                'scope_id' => 16,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:54:20',
                'updated_at' => '2022-11-12 16:54:20',
            ),
            10 => 
            array (
                'id' => 12,
                'book_id' => 1,
                'card_id' => 4,
                'scope_id' => 12,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:55:00',
                'updated_at' => '2022-11-12 16:55:00',
            ),
            11 => 
            array (
                'id' => 13,
                'book_id' => 1,
                'card_id' => 20,
                'scope_id' => 13,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:55:11',
                'updated_at' => '2022-11-12 16:55:11',
            ),
            12 => 
            array (
                'id' => 14,
                'book_id' => 1,
                'card_id' => 10,
                'scope_id' => 11,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:55:49',
                'updated_at' => '2022-11-12 16:55:49',
            ),
            13 => 
            array (
                'id' => 15,
                'book_id' => 1,
                'card_id' => 27,
                'scope_id' => 13,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:59:05',
                'updated_at' => '2022-11-12 16:59:05',
            ),
            14 => 
            array (
                'id' => 16,
                'book_id' => 1,
                'card_id' => 41,
                'scope_id' => 3,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:59:22',
                'updated_at' => '2022-11-12 16:59:22',
            ),
        ));
        
        
    }
}