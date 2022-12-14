<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('areas')->delete();
        
        \DB::table('areas')->insert(array (
            0 => 
            array (
                'id' => 3,
                'name' => '{"en":"Savanna Tract"}',
                'code' => NULL,
                'scope_id' => 23,
                'dome_id' => 1,
                'top_step' => 13,
                'top' => 3810,
                'left_step' => 16,
                'left' => 2703,
                'markers' => NULL,
                'image' => 'area/muP5RRJ4biUVRVvfCLw9rs6tgqj8PNOdetsfJlfX.png',
                'desc' => '{"en":null}',
                'is_public' => false,
                'owner_id' => 1,
                'created_at' => '2022-12-04 16:30:36',
                'updated_at' => '2022-12-04 20:18:18',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '{"en":"Deep Forest"}',
                'code' => NULL,
                'scope_id' => 32,
                'dome_id' => 1,
                'top_step' => 13,
                'top' => 3809,
                'left_step' => 20,
                'left' => 3378,
                'markers' => NULL,
                'image' => 'area/6LkWTYFliWvntlsZwZ3MUER9FVZRPaezJpE57Mwb.png',
                'desc' => '{"en":null}',
                'is_public' => false,
                'owner_id' => 1,
                'created_at' => '2022-12-04 16:05:21',
                'updated_at' => '2022-12-04 20:25:07',
            ),
            2 => 
            array (
                'id' => 1,
                'name' => '{"en":"River of Birth","ru":"Река Рождения"}',
                'code' => NULL,
                'scope_id' => 33,
                'dome_id' => 1,
                'top_step' => 13,
                'top' => 3809,
                'left_step' => 18,
                'left' => 3042,
                'markers' => NULL,
                'image' => 'area/ajSwLaeERJgJRdMdZqwrff9TSj47iQujPk2wgWRD.png',
                'desc' => '{"ru":null}',
                'is_public' => false,
                'owner_id' => 1,
                'created_at' => '2022-12-04 07:56:45',
                'updated_at' => '2022-12-04 20:35:34',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => '{"en":"The Lost Tribes"}',
                'code' => NULL,
                'scope_id' => 99,
                'dome_id' => 1,
                'top_step' => 12,
                'top' => 3516,
                'left_step' => 17,
                'left' => 2872,
                'markers' => NULL,
                'image' => 'area/pTfTMYtmySo5iXWVvbVhksdM3SL0gJFWFu9rBR0F.png',
                'desc' => '{"en":null}',
                'is_public' => false,
                'owner_id' => 1,
                'created_at' => '2022-12-24 23:16:34',
                'updated_at' => '2022-12-24 23:22:07',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => '{"en":"The Dangerous Delta"}',
                'code' => NULL,
                'scope_id' => 100,
                'dome_id' => 1,
                'top_step' => 12,
                'top' => 3516,
                'left_step' => 19,
                'left' => 3209,
                'markers' => NULL,
                'image' => 'area/8vuX973u1KH8W9KEA7AgEdlQzxkkEiKauuZLcWPx.png',
                'desc' => '{"en":null}',
                'is_public' => false,
                'owner_id' => 1,
                'created_at' => '2022-12-25 00:11:25',
                'updated_at' => '2022-12-25 00:12:43',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => '{"en":"Arid Jungles"}',
                'code' => NULL,
                'scope_id' => 101,
                'dome_id' => 1,
                'top_step' => 14,
                'top' => 4102,
                'left_step' => 17,
                'left' => 2871,
                'markers' => NULL,
                'image' => 'area/QL9GJ65pqmTFuKXvrc4SYpLABBZgeODdCOjNFoM8.png',
                'desc' => '{"en":null}',
                'is_public' => false,
                'owner_id' => 1,
                'created_at' => '2022-12-25 00:39:39',
                'updated_at' => '2022-12-25 00:40:52',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => '{"en":"Outskirts"}',
                'code' => NULL,
                'scope_id' => 102,
                'dome_id' => 1,
                'top_step' => 14,
                'top' => 4104,
                'left_step' => 19,
                'left' => 3209,
                'markers' => NULL,
                'image' => 'area/0cnMbGYmRhCH0xdywsJDBTCixy61VCxtDrO2cWvK.png',
                'desc' => '{"en":null}',
                'is_public' => false,
                'owner_id' => 1,
                'created_at' => '2022-12-25 01:34:01',
                'updated_at' => '2022-12-25 01:38:10',
            ),
        ));
        
        
    }
}