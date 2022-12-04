<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DomesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('domes')->delete();
        
        \DB::table('domes')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => '{"en":"Serpent\'s Lair"}',
                'code' => NULL,
                'scope_id' => NULL,
                'card_id' => 98,
                'area_width' => 356,
                'area_height' => 412,
                'top_step' => 309,
                'left_step' => 178,
                'area_mask' => '[178,0,356,104,356,308,178,412,0,308,0,104]',
                'image' => 'dome/8DkCQyny5RNYVbhm4Dj2HMWnXjNUuBK8Ww7BH9TF.png',
                'desc' => '{"en":null}',
                'is_public' => false,
                'owner_id' => 1,
                'created_at' => '2022-12-04 07:44:40',
                'updated_at' => '2022-12-04 17:02:29',
            ),
        ));
        
        
    }
}