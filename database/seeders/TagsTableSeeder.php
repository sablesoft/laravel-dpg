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
                'id' => 5,
                'name' => '{"ru":"Место","en":"Place"}',
                'desc' => '{"en":null}',
                'is_public' => true,
                'image' => NULL,
                'scope_id' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-08 02:56:32',
                'updated_at' => '2022-11-08 17:40:21',
            ),
            1 => 
            array (
                'id' => 1,
                'name' => '{"en":"Info","ru":"Инфо"}',
                'desc' => '{"en":null}',
                'is_public' => true,
                'image' => NULL,
                'scope_id' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-06 05:07:36',
                'updated_at' => '2022-11-08 17:40:42',
            ),
            2 => 
            array (
                'id' => 2,
                'name' => '{"en":"Creature","ru":"Существо"}',
                'desc' => '{"en":null}',
                'is_public' => true,
                'image' => NULL,
                'scope_id' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-08 02:11:58',
                'updated_at' => '2022-11-08 17:40:54',
            ),
            3 => 
            array (
                'id' => 7,
                'name' => '{"en":"Insect","ru":"Насекомое"}',
                'desc' => '{"ru":null}',
                'is_public' => false,
                'image' => NULL,
                'scope_id' => 2,
                'owner_id' => 1,
                'created_at' => '2022-11-08 02:18:53',
                'updated_at' => '2022-11-08 02:19:38',
            ),
            4 => 
            array (
                'id' => 8,
                'name' => '{"en":"Spirit","ru":"Дух"}',
                'desc' => '{"ru":null}',
                'is_public' => false,
                'image' => NULL,
                'scope_id' => 4,
                'owner_id' => 1,
                'created_at' => '2022-11-08 02:43:41',
                'updated_at' => '2022-11-08 02:44:22',
            ),
            5 => 
            array (
                'id' => 10,
                'name' => '{"en":"Legend","ru":"Легенда"}',
                'desc' => '{"en":null}',
                'is_public' => true,
                'image' => NULL,
                'scope_id' => 1,
                'owner_id' => 1,
                'created_at' => '2022-11-06 05:07:52',
                'updated_at' => '2022-11-08 17:42:46',
            ),
            6 => 
            array (
                'id' => 12,
                'name' => '{"en":"Animal","ru":"Животное"}',
                'desc' => '{"en":null}',
                'is_public' => true,
                'image' => NULL,
                'scope_id' => 2,
                'owner_id' => 1,
                'created_at' => '2022-11-08 02:13:44',
                'updated_at' => '2022-11-08 17:43:10',
            ),
            7 => 
            array (
                'id' => 13,
                'name' => '{"en":"Plant","ru":"Растение"}',
                'desc' => '{"en":null}',
                'is_public' => true,
                'image' => NULL,
                'scope_id' => 2,
                'owner_id' => 1,
                'created_at' => '2022-11-08 02:14:35',
                'updated_at' => '2022-11-08 17:43:38',
            ),
            8 => 
            array (
                'id' => 14,
                'name' => '{"en":"Human","ru":"Человек"}',
                'desc' => '{"en":null}',
                'is_public' => true,
                'image' => NULL,
                'scope_id' => 2,
                'owner_id' => 1,
                'created_at' => '2022-11-08 02:15:03',
                'updated_at' => '2022-11-08 17:44:02',
            ),
            9 => 
            array (
                'id' => 15,
                'name' => '{"en":"Event","ru":"Событие"}',
                'desc' => '{"ru":null}',
                'is_public' => true,
                'image' => NULL,
                'scope_id' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-09 04:51:54',
                'updated_at' => '2022-11-10 01:49:48',
            ),
            10 => 
            array (
                'id' => 17,
                'name' => '{"en":"Wilderness"}',
                'desc' => '{"en":null}',
                'is_public' => true,
                'image' => NULL,
                'scope_id' => 5,
                'owner_id' => 1,
                'created_at' => '2022-11-10 14:24:51',
                'updated_at' => '2022-11-10 14:24:51',
            ),
            11 => 
            array (
                'id' => 9,
                'name' => '{"ru":"Джунгли","en":"Rainforest"}',
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'scope_id' => 17,
                'owner_id' => 1,
                'created_at' => '2022-11-08 02:56:49',
                'updated_at' => '2022-11-10 14:25:17',
            ),
            12 => 
            array (
                'id' => 18,
                'name' => '{"en":"Settlement"}',
                'desc' => '{"en":null}',
                'is_public' => true,
                'image' => NULL,
                'scope_id' => 5,
                'owner_id' => 1,
                'created_at' => '2022-11-10 14:26:20',
                'updated_at' => '2022-11-10 14:26:20',
            ),
            13 => 
            array (
                'id' => 19,
                'name' => '{"en":"Rest"}',
                'desc' => '{"en":null}',
                'is_public' => true,
                'image' => NULL,
                'scope_id' => 15,
                'owner_id' => 1,
                'created_at' => '2022-11-10 14:36:47',
                'updated_at' => '2022-11-10 14:36:47',
            ),
            14 => 
            array (
                'id' => 20,
                'name' => '{"en":"Practice"}',
                'desc' => '{"en":null}',
                'is_public' => true,
                'image' => NULL,
                'scope_id' => 15,
                'owner_id' => 1,
                'created_at' => '2022-11-10 14:36:58',
                'updated_at' => '2022-11-10 14:36:58',
            ),
            15 => 
            array (
                'id' => 21,
                'name' => '{"en":"Find"}',
                'desc' => '{"en":null}',
                'is_public' => true,
                'image' => NULL,
                'scope_id' => 15,
                'owner_id' => 1,
                'created_at' => '2022-11-10 14:39:42',
                'updated_at' => '2022-11-10 14:39:42',
            ),
            16 => 
            array (
                'id' => 22,
                'name' => '{"en":"Hero"}',
                'desc' => '{"en":null}',
                'is_public' => true,
                'image' => NULL,
                'scope_id' => 3,
                'owner_id' => 1,
                'created_at' => '2022-11-10 23:33:23',
                'updated_at' => '2022-11-10 23:33:23',
            ),
            17 => 
            array (
                'id' => 23,
                'name' => '{"en":"Quest"}',
                'desc' => '{"en":null}',
                'is_public' => true,
                'image' => NULL,
                'scope_id' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-10 23:33:42',
                'updated_at' => '2022-11-10 23:33:42',
            ),
            18 => 
            array (
                'id' => 24,
                'name' => '{"en":"Item"}',
                'desc' => '{"en":null}',
                'is_public' => true,
                'image' => NULL,
                'scope_id' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-10 23:57:58',
                'updated_at' => '2022-11-10 23:57:58',
            ),
            19 => 
            array (
                'id' => 16,
                'name' => '{"en":"Encounter","ru":"Встреча"}',
                'desc' => '{"en":null}',
                'is_public' => true,
                'image' => NULL,
                'scope_id' => 15,
                'owner_id' => 1,
                'created_at' => '2022-11-09 04:55:16',
                'updated_at' => '2022-11-11 00:07:30',
            ),
            20 => 
            array (
                'id' => 11,
                'name' => '{"en":"Clan","ru":"Клан"}',
                'desc' => '{"en":null}',
                'is_public' => true,
                'image' => NULL,
                'scope_id' => 1,
                'owner_id' => 1,
                'created_at' => '2022-11-06 05:08:04',
                'updated_at' => '2022-11-11 00:08:20',
            ),
            21 => 
            array (
                'id' => 3,
                'name' => '{"en":"Character","ru":"Персонаж"}',
                'desc' => '{"en":null}',
                'is_public' => true,
                'image' => NULL,
                'scope_id' => 2,
                'owner_id' => 1,
                'created_at' => '2022-11-08 02:20:38',
                'updated_at' => '2022-11-11 00:08:52',
            ),
            22 => 
            array (
                'id' => 4,
                'name' => '{"en":"Power","ru":"Сила"}',
                'desc' => '{"en":null}',
                'is_public' => true,
                'image' => NULL,
                'scope_id' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-08 02:43:27',
                'updated_at' => '2022-11-11 00:09:25',
            ),
            23 => 
            array (
                'id' => 6,
                'name' => '{"en":"Bird","ru":"Птица"}',
                'desc' => '{"en":null}',
                'is_public' => true,
                'image' => NULL,
                'scope_id' => 2,
                'owner_id' => 1,
                'created_at' => '2022-11-08 02:17:34',
                'updated_at' => '2022-11-11 00:09:59',
            ),
        ));
        
        
    }
}