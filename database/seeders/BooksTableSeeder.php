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
                'id' => 1,
                'name' => '{"en":"Rainforest Legends","ru":"Поиски Тотема"}',
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => 'N5ru4ZmxP9ifSV2oGbaBfgUPkIaUG5om9lFwxIiX.jpg',
                'scope_id' => NULL,
                'hero_id' => 3,
                'quest_id' => 22,
                'owner_id' => 1,
                'created_at' => '2022-11-06 05:07:24',
                'updated_at' => '2022-11-10 23:41:53',
            ),
        ));
        
        
    }
}