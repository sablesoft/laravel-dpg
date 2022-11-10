<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BookTagTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('book_tag')->delete();
        
        \DB::table('book_tag')->insert(array (
            0 => 
            array (
                'book_id' => 1,
                'tag_id' => 10,
            ),
        ));
        
        
    }
}