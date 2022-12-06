<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DomeSourceTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('dome_source')->delete();
        
        \DB::table('dome_source')->insert(array (
            0 => 
            array (
                'dome_id' => 1,
                'source_id' => 1,
            ),
        ));
        
        
    }
}