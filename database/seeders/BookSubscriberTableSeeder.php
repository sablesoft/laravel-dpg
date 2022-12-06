<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BookSubscriberTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('book_subscriber')->delete();
        
        \DB::table('book_subscriber')->insert(array (
            0 => 
            array (
                'book_id' => 1,
                'subscriber_id' => 4,
                'type' => 0,
            ),
        ));
        
        
    }
}