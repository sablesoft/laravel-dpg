<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ScopesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('scopes')->delete();
        
        \DB::table('scopes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '{"en":"Info","ru":"Инфо"}',
                'desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-06 05:07:36',
                'updated_at' => '2022-11-06 06:48:40',
            ),
        ));
        
        
    }
}