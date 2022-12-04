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
        ));
        
        
    }
}