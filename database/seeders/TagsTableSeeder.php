<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tags')->delete();
        
        \DB::table('tags')->insert(array (
            0 => 
            array (
                'id' => 2,
                'scope_id' => 1,
                'image' => NULL,
                'name' => '{"en":"Clan","ru":"Клан"}',
                'desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-06 05:08:04',
                'updated_at' => '2022-11-06 06:48:54',
            ),
            1 => 
            array (
                'id' => 6,
                'scope_id' => 2,
                'image' => NULL,
                'name' => '{"en":"Bird","ru":"Птица"}',
                'desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-08 02:17:34',
                'updated_at' => '2022-11-08 02:19:24',
            ),
            2 => 
            array (
                'id' => 7,
                'scope_id' => 2,
                'image' => NULL,
                'name' => '{"en":"Insect","ru":"Насекомое"}',
                'desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-08 02:18:53',
                'updated_at' => '2022-11-08 02:19:38',
            ),
            3 => 
            array (
                'id' => 8,
                'scope_id' => 4,
                'image' => NULL,
                'name' => '{"en":"Spirit","ru":"Дух"}',
                'desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-08 02:43:41',
                'updated_at' => '2022-11-08 02:44:22',
            ),
            4 => 
            array (
                'id' => 9,
                'scope_id' => 5,
                'image' => NULL,
                'name' => '{"ru":"Джунгли","en":"Rainforest"}',
                'desc' => '{"en":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-08 02:56:49',
                'updated_at' => '2022-11-08 02:57:48',
            ),
            5 => 
            array (
                'id' => 1,
                'scope_id' => 1,
                'image' => NULL,
                'name' => '{"en":"Legend","ru":"Легенда"}',
                'desc' => '{"en":null}',
                'owner_id' => 1,
                'is_public' => true,
                'created_at' => '2022-11-06 05:07:52',
                'updated_at' => '2022-11-08 17:42:46',
            ),
            6 => 
            array (
                'id' => 3,
                'scope_id' => 2,
                'image' => NULL,
                'name' => '{"en":"Animal","ru":"Животное"}',
                'desc' => '{"en":null}',
                'owner_id' => 1,
                'is_public' => true,
                'created_at' => '2022-11-08 02:13:44',
                'updated_at' => '2022-11-08 17:43:10',
            ),
            7 => 
            array (
                'id' => 4,
                'scope_id' => 2,
                'image' => NULL,
                'name' => '{"en":"Plant","ru":"Растение"}',
                'desc' => '{"en":null}',
                'owner_id' => 1,
                'is_public' => true,
                'created_at' => '2022-11-08 02:14:35',
                'updated_at' => '2022-11-08 17:43:38',
            ),
            8 => 
            array (
                'id' => 5,
                'scope_id' => 2,
                'image' => NULL,
                'name' => '{"en":"Human","ru":"Человек"}',
                'desc' => '{"en":null}',
                'owner_id' => 1,
                'is_public' => true,
                'created_at' => '2022-11-08 02:15:03',
                'updated_at' => '2022-11-08 17:44:02',
            ),
        ));
        
        
    }
}