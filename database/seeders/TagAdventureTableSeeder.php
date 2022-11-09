<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagAdventureTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tag_adventure')->delete();
        
        \DB::table('tag_adventure')->insert(array (
            0 => 
            array (
                'tag_id' => 10,
                'adventure_id' => 1,
            ),
        ));
        
        
    }
}