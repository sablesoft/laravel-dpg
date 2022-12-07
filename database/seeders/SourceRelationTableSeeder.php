<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SourceRelationTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('source_relation')->delete();
        
        \DB::table('source_relation')->insert(array (
            0 => 
            array (
                'source_id' => 1,
                'book_id' => NULL,
                'dome_id' => NULL,
                'land_id' => NULL,
                'area_id' => 1,
            ),
            1 => 
            array (
                'source_id' => 1,
                'book_id' => NULL,
                'dome_id' => 1,
                'land_id' => NULL,
                'area_id' => NULL,
            ),
            2 => 
            array (
                'source_id' => 1,
                'book_id' => 2,
                'dome_id' => NULL,
                'land_id' => NULL,
                'area_id' => NULL,
            ),
            3 => 
            array (
                'source_id' => 1,
                'book_id' => NULL,
                'dome_id' => NULL,
                'land_id' => 1,
                'area_id' => NULL,
            ),
        ));
        
        
    }
}