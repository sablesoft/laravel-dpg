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
            1 => 
            array (
                'book_id' => 1,
                'tag_id' => 12,
            ),
            2 => 
            array (
                'book_id' => 1,
                'tag_id' => 6,
            ),
            3 => 
            array (
                'book_id' => 1,
                'tag_id' => 3,
            ),
            4 => 
            array (
                'book_id' => 1,
                'tag_id' => 11,
            ),
            5 => 
            array (
                'book_id' => 1,
                'tag_id' => 2,
            ),
            6 => 
            array (
                'book_id' => 1,
                'tag_id' => 16,
            ),
            7 => 
            array (
                'book_id' => 1,
                'tag_id' => 15,
            ),
            8 => 
            array (
                'book_id' => 1,
                'tag_id' => 21,
            ),
            9 => 
            array (
                'book_id' => 1,
                'tag_id' => 22,
            ),
            10 => 
            array (
                'book_id' => 1,
                'tag_id' => 14,
            ),
            11 => 
            array (
                'book_id' => 1,
                'tag_id' => 1,
            ),
            12 => 
            array (
                'book_id' => 1,
                'tag_id' => 7,
            ),
            13 => 
            array (
                'book_id' => 1,
                'tag_id' => 24,
            ),
            14 => 
            array (
                'book_id' => 1,
                'tag_id' => 5,
            ),
            15 => 
            array (
                'book_id' => 1,
                'tag_id' => 13,
            ),
            16 => 
            array (
                'book_id' => 1,
                'tag_id' => 4,
            ),
            17 => 
            array (
                'book_id' => 1,
                'tag_id' => 20,
            ),
            18 => 
            array (
                'book_id' => 1,
                'tag_id' => 23,
            ),
            19 => 
            array (
                'book_id' => 1,
                'tag_id' => 9,
            ),
            20 => 
            array (
                'book_id' => 1,
                'tag_id' => 19,
            ),
            21 => 
            array (
                'book_id' => 1,
                'tag_id' => 18,
            ),
            22 => 
            array (
                'book_id' => 1,
                'tag_id' => 8,
            ),
            23 => 
            array (
                'book_id' => 1,
                'tag_id' => 17,
            ),
        ));
        
        
    }
}