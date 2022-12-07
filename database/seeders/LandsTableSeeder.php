<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LandsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('lands')->delete();
        
        \DB::table('lands')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '{"en":"Rainforest"}',
                'code' => NULL,
                'scope_id' => 35,
                'dome_id' => 1,
                'image' => NULL,
                'desc' => '{"en":null}',
                'is_public' => false,
                'owner_id' => 1,
                'created_at' => '2022-12-07 02:24:58',
                'updated_at' => '2022-12-07 02:24:58',
            ),
        ));
        
        
    }
}