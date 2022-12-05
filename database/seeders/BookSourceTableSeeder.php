<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BookSourceTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('book_source')->delete();
        
        \DB::table('book_source')->insert(array (
            0 => 
            array (
                'book_id' => 2,
                'source_id' => 1,
            ),
        ));
        
        
    }
}