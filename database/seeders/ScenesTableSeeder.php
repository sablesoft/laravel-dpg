<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ScenesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('scenes')->delete();
        
        \DB::table('scenes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '{"en":"Obsidian Chasm"}',
                'code' => NULL,
                'scope_id' => 98,
                'markers' => NULL,
                'image' => 'scene/WGDzMINqXdliIv7BTSQmrI1AXJvB2HGJs91wBV9L.png',
                'desc' => '{"en":"It was here, in the depths of this dangerous cave, that ancient tablets with the history of ancestors were hidden."}',
                'is_public' => false,
                'owner_id' => 1,
                'created_at' => '2022-12-10 17:29:53',
                'updated_at' => '2022-12-10 17:36:55',
            ),
        ));
        
        
    }
}