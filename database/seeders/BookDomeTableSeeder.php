<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BookDomeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('book_dome')->delete();
        
        \DB::table('book_dome')->insert(array (
            0 => 
            array (
                'book_id' => 1,
                'dome_id' => 2,
            ),
        ));
        
        
    }
}