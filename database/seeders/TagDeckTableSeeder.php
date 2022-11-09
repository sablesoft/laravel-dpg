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
        
        
        
    }
}