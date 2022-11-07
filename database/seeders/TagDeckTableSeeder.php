<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagDeckTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tag_deck')->delete();
        
        \DB::table('tag_deck')->insert(array (
            0 => 
            array (
                'tag_id' => 1,
                'deck_id' => 1,
            ),
        ));
        
        
    }
}