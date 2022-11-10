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
                'id' => 4,
                'scope_id' => NULL,
                'image' => NULL,
                'name' => '{"en":"Power","ru":"Сила"}',
                'desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-08 02:43:27',
                'updated_at' => '2022-11-08 02:44:09',
            ),
            1 => 
            array (
                'id' => 5,
                'scope_id' => NULL,
                'image' => NULL,
                'name' => '{"ru":"Место","en":"Place"}',
                'desc' => '{"en":null}',
                'owner_id' => 1,
                'is_public' => true,
                'created_at' => '2022-11-08 02:56:32',
                'updated_at' => '2022-11-08 17:40:21',
            ),
            2 => 
            array (
                'id' => 1,
                'scope_id' => NULL,
                'image' => NULL,
                'name' => '{"en":"Info","ru":"Инфо"}',
                'desc' => '{"en":null}',
                'owner_id' => 1,
                'is_public' => true,
                'created_at' => '2022-11-06 05:07:36',
                'updated_at' => '2022-11-08 17:40:42',
            ),
            3 => 
            array (
                'id' => 2,
                'scope_id' => NULL,
                'image' => NULL,
                'name' => '{"en":"Creature","ru":"Существо"}',
                'desc' => '{"en":null}',
                'owner_id' => 1,
                'is_public' => true,
                'created_at' => '2022-11-08 02:11:58',
                'updated_at' => '2022-11-08 17:40:54',
            ),
            4 => 
            array (
                'id' => 11,
                'scope_id' => 1,
                'image' => NULL,
                'name' => '{"en":"Clan","ru":"Клан"}',
                'desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-06 05:08:04',
                'updated_at' => '2022-11-06 06:48:54',
            ),
            5 => 
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
            6 => 
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
            7 => 
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
            8 => 
            array (
                'id' => 10,
                'scope_id' => 1,
                'image' => NULL,
                'name' => '{"en":"Legend","ru":"Легенда"}',
                'desc' => '{"en":null}',
                'owner_id' => 1,
                'is_public' => true,
                'created_at' => '2022-11-06 05:07:52',
                'updated_at' => '2022-11-08 17:42:46',
            ),
            9 => 
            array (
                'id' => 12,
                'scope_id' => 2,
                'image' => NULL,
                'name' => '{"en":"Animal","ru":"Животное"}',
                'desc' => '{"en":null}',
                'owner_id' => 1,
                'is_public' => true,
                'created_at' => '2022-11-08 02:13:44',
                'updated_at' => '2022-11-08 17:43:10',
            ),
            10 => 
            array (
                'id' => 13,
                'scope_id' => 2,
                'image' => NULL,
                'name' => '{"en":"Plant","ru":"Растение"}',
                'desc' => '{"en":null}',
                'owner_id' => 1,
                'is_public' => true,
                'created_at' => '2022-11-08 02:14:35',
                'updated_at' => '2022-11-08 17:43:38',
            ),
            11 => 
            array (
                'id' => 14,
                'scope_id' => 2,
                'image' => NULL,
                'name' => '{"en":"Human","ru":"Человек"}',
                'desc' => '{"en":null}',
                'owner_id' => 1,
                'is_public' => true,
                'created_at' => '2022-11-08 02:15:03',
                'updated_at' => '2022-11-08 17:44:02',
            ),
            12 => 
            array (
                'id' => 3,
                'scope_id' => 2,
                'image' => NULL,
                'name' => '{"en":"Character","ru":"Персонаж"}',
                'desc' => '{"en":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-08 02:20:38',
                'updated_at' => '2022-11-09 05:06:49',
            ),
            13 => 
            array (
                'id' => 16,
                'scope_id' => 15,
                'image' => NULL,
                'name' => '{"en":"Encounter","ru":"Встреча"}',
                'desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-09 04:55:16',
                'updated_at' => '2022-11-10 01:49:12',
            ),
            14 => 
            array (
                'id' => 15,
                'scope_id' => NULL,
                'image' => NULL,
                'name' => '{"en":"Event","ru":"Событие"}',
                'desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => true,
                'created_at' => '2022-11-09 04:51:54',
                'updated_at' => '2022-11-10 01:49:48',
            ),
            15 => 
            array (
                'id' => 17,
                'scope_id' => 5,
                'image' => NULL,
                'name' => '{"en":"Wilderness"}',
                'desc' => '{"en":null}',
                'owner_id' => 1,
                'is_public' => true,
                'created_at' => '2022-11-10 14:24:51',
                'updated_at' => '2022-11-10 14:24:51',
            ),
            16 => 
            array (
                'id' => 9,
                'scope_id' => 17,
                'image' => NULL,
                'name' => '{"ru":"Джунгли","en":"Rainforest"}',
                'desc' => '{"en":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-08 02:56:49',
                'updated_at' => '2022-11-10 14:25:17',
            ),
            17 => 
            array (
                'id' => 18,
                'scope_id' => 5,
                'image' => NULL,
                'name' => '{"en":"Settlement"}',
                'desc' => '{"en":null}',
                'owner_id' => 1,
                'is_public' => true,
                'created_at' => '2022-11-10 14:26:20',
                'updated_at' => '2022-11-10 14:26:20',
            ),
            18 => 
            array (
                'id' => 19,
                'scope_id' => 15,
                'image' => NULL,
                'name' => '{"en":"Rest"}',
                'desc' => '{"en":null}',
                'owner_id' => 1,
                'is_public' => true,
                'created_at' => '2022-11-10 14:36:47',
                'updated_at' => '2022-11-10 14:36:47',
            ),
            19 => 
            array (
                'id' => 20,
                'scope_id' => 15,
                'image' => NULL,
                'name' => '{"en":"Practice"}',
                'desc' => '{"en":null}',
                'owner_id' => 1,
                'is_public' => true,
                'created_at' => '2022-11-10 14:36:58',
                'updated_at' => '2022-11-10 14:36:58',
            ),
            20 => 
            array (
                'id' => 21,
                'scope_id' => 15,
                'image' => NULL,
                'name' => '{"en":"Find"}',
                'desc' => '{"en":null}',
                'owner_id' => 1,
                'is_public' => true,
                'created_at' => '2022-11-10 14:39:42',
                'updated_at' => '2022-11-10 14:39:42',
            ),
        ));
        
        
    }
}