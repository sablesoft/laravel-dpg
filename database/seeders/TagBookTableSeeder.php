<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagBookTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('tag_book')->delete();

        \DB::table('tag_book')->insert(array (
            0 =>
            array (
                'tag_id' => 10,
                'book_id' => 1,
            ),
        ));


    }
}
