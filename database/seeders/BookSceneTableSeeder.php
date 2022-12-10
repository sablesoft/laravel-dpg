<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BookSceneTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('book_scene')->delete();
        
        \DB::table('book_scene')->insert(array (
            0 => 
            array (
                'book_id' => 2,
                'scene_id' => 1,
            ),
        ));
        
        
    }
}