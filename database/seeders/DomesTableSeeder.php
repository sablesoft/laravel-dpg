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
                'id' => 1,
                'name' => '{"en":"Serpent\'s Lair","ru":"Гнездо Змея"}',
                'code' => NULL,
                'scope_id' => 96,
                'area_width' => '338.00',
                'area_height' => '388.00',
                'map_width' => '5574.00',
                'map_height' => '6535.00',
                'top_step' => '293.00',
                'left_step' => '168.90',
                'area_mask' => '[169,0,338,94,338,294,169,388,0,294,0,94]',
                'image' => 'dome/U6uCXxiq4priVPCDTXtDgAgk5cDvLBGSaDq4mdlW.png',
                'desc' => '{"en":null}',
                'is_public' => false,
                'owner_id' => 1,
                'created_at' => '2022-12-04 07:44:40',
                'updated_at' => '2022-12-12 18:42:45',
            ),
        ));
        
        
    }
}