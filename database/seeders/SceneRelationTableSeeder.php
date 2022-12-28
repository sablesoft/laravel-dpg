<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SceneRelationTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('scene_relation')->delete();
        
        \DB::table('scene_relation')->insert(array (
            0 => 
            array (
                'scene_id' => 1,
                'book_id' => NULL,
                'dome_id' => NULL,
                'land_id' => NULL,
                'area_id' => 1,
            ),
        ));
        
        
    }
}