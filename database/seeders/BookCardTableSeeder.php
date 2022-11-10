<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BookCardTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('book_card')->delete();
        
        \DB::table('book_card')->insert(array (
            0 => 
            array (
                'book_id' => 1,
                'card_id' => 8,
            ),
            1 => 
            array (
                'book_id' => 1,
                'card_id' => 10,
            ),
            2 => 
            array (
                'book_id' => 1,
                'card_id' => 16,
            ),
            3 => 
            array (
                'book_id' => 1,
                'card_id' => 4,
            ),
            4 => 
            array (
                'book_id' => 1,
                'card_id' => 14,
            ),
            5 => 
            array (
                'book_id' => 1,
                'card_id' => 12,
            ),
            6 => 
            array (
                'book_id' => 1,
                'card_id' => 2,
            ),
            7 => 
            array (
                'book_id' => 1,
                'card_id' => 15,
            ),
            8 => 
            array (
                'book_id' => 1,
                'card_id' => 21,
            ),
            9 => 
            array (
                'book_id' => 1,
                'card_id' => 18,
            ),
            10 => 
            array (
                'book_id' => 1,
                'card_id' => 20,
            ),
            11 => 
            array (
                'book_id' => 1,
                'card_id' => 9,
            ),
            12 => 
            array (
                'book_id' => 1,
                'card_id' => 11,
            ),
            13 => 
            array (
                'book_id' => 1,
                'card_id' => 6,
            ),
            14 => 
            array (
                'book_id' => 1,
                'card_id' => 19,
            ),
            15 => 
            array (
                'book_id' => 1,
                'card_id' => 1,
            ),
            16 => 
            array (
                'book_id' => 1,
                'card_id' => 7,
            ),
            17 => 
            array (
                'book_id' => 1,
                'card_id' => 13,
            ),
            18 => 
            array (
                'book_id' => 1,
                'card_id' => 3,
            ),
            19 => 
            array (
                'book_id' => 1,
                'card_id' => 17,
            ),
            20 => 
            array (
                'book_id' => 1,
                'card_id' => 5,
            ),
        ));
        
        
    }
}