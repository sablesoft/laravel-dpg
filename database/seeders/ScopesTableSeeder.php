<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ScopesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('scopes')->delete();
        
        \DB::table('scopes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'image' => NULL,
                'name' => '{"en":"Info","ru":"Инфо"}',
                'desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-06 05:07:36',
                'updated_at' => '2022-11-06 06:48:40',
            ),
            1 => 
            array (
                'id' => 2,
                'image' => NULL,
                'name' => '{"en":"Creature","ru":"Существо"}',
                'desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-08 02:11:58',
                'updated_at' => '2022-11-08 02:12:28',
            ),
            2 => 
            array (
                'id' => 3,
                'image' => NULL,
                'name' => '{"en":"Character","ru":"Персонаж"}',
                'desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-08 02:20:38',
                'updated_at' => '2022-11-08 02:20:54',
            ),
            3 => 
            array (
                'id' => 4,
                'image' => NULL,
                'name' => '{"en":"Power","ru":"Сила"}',
                'desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-08 02:43:27',
                'updated_at' => '2022-11-08 02:44:09',
            ),
            4 => 
            array (
                'id' => 5,
                'image' => NULL,
                'name' => '{"ru":"Место","en":"Place"}',
                'desc' => '{"en":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-08 02:56:32',
                'updated_at' => '2022-11-08 02:59:25',
            ),
        ));
        
        
    }
}