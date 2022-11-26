<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('books')->delete();
        
        \DB::table('books')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => '{"en":"Core","ru":"Ядро"}',
                'desc' => '{"en":"Book with base abstract cards and decks","ru":"Книга с базовыми абстрактными картами и колодами"}',
                'is_public' => true,
                'image' => 'book/YAgZjoKyE3lZeVxHo03hMKNKdG4e3fwf4db3kylV.png',
                'scope_id' => NULL,
                'cards_back' => 'back/2K3RgfkXM7GxyVsfm3MjO3UGZZEmqyjcazy87aYe.png',
                'owner_id' => 1,
                'created_at' => '2022-11-25 01:08:56',
                'updated_at' => '2022-11-25 04:10:39',
            ),
            1 => 
            array (
                'id' => 1,
                'name' => '{"en":"Rainforest Dreams","ru":"Сны Дождливых Лесов"}',
                'desc' => '{"ru":null}',
                'is_public' => false,
                'image' => 'book/9nMEX5TG126Xo3u4RXxB0L5JQCBib8mDCnrgNo4Y.jpg',
                'scope_id' => NULL,
                'cards_back' => 'back/vgsvSjrgQW3pft9mk67LYr2oCGdsqpa29u71U2GQ.png',
                'owner_id' => 1,
                'created_at' => '2022-11-06 05:07:24',
                'updated_at' => '2022-11-21 21:37:46',
            ),
        ));
        
        
    }
}