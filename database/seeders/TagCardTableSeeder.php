<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagCardTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tag_card')->delete();
        
        \DB::table('tag_card')->insert(array (
            0 => 
            array (
                'tag_id' => 1,
                'card_id' => 1,
            ),
            1 => 
            array (
                'tag_id' => 2,
                'card_id' => 1,
            ),
            2 => 
            array (
                'tag_id' => 2,
                'card_id' => 2,
            ),
            3 => 
            array (
                'tag_id' => 1,
                'card_id' => 2,
            ),
        ));
        
        
    }
}