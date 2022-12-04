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
                'id' => 2,
                'name' => '{"en":"River of Birth"}',
                'code' => NULL,
                'scope_id' => NULL,
                'dome_id' => 2,
                'card_id' => 33,
                'top_step' => 13,
                'top' => 4030,
                'left_step' => 26,
                'left' => 4628,
                'markers' => NULL,
                'image' => 'area/iWnUIqv60sjDA58U1EeKaeM9ZlQpvqvIEk4UZoOs.png',
                'desc' => '{"en":null}',
                'is_public' => false,
                'owner_id' => 1,
                'created_at' => '2022-12-04 07:56:45',
                'updated_at' => '2022-12-04 08:37:38',
            ),
            1 => 
            array (
                'id' => 4,
                'name' => '{"en":"Test"}',
                'code' => NULL,
                'scope_id' => NULL,
                'dome_id' => 2,
                'card_id' => 100,
                'top_step' => 1,
                'top' => 310,
                'left_step' => 1,
                'left' => 178,
                'markers' => NULL,
                'image' => 'area/Oqnlf21DmhB1LkPcxp7rpq8vlS64ejUgltIqBCoJ.png',
                'desc' => '{"en":null}',
                'is_public' => false,
                'owner_id' => 1,
                'created_at' => '2022-12-04 16:30:36',
                'updated_at' => '2022-12-04 16:51:37',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '{"en":"Rainforest\'s Heart"}',
                'code' => NULL,
                'scope_id' => NULL,
                'dome_id' => 2,
                'card_id' => 99,
                'top_step' => 13,
                'top' => 4017,
                'left_step' => 27,
                'left' => 4806,
                'markers' => NULL,
                'image' => 'area/sd2GBYlTyg52luh2oP42YEy0pozjvk1PXa9GHM1h.png',
                'desc' => '{"en":null}',
                'is_public' => false,
                'owner_id' => 1,
                'created_at' => '2022-12-04 16:05:21',
                'updated_at' => '2022-12-04 17:03:28',
            ),
        ));
        
        
    }
}