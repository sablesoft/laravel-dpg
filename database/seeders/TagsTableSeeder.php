<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tags')->delete();
        
        \DB::table('tags')->insert(array (
            0 => 
            array (
                'id' => 2,
                'scope_id' => 1,
                'name' => '{"en":"Clan","ru":"Клан"}',
                'desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-06 05:08:04',
                'updated_at' => '2022-11-06 06:48:54',
            ),
            1 => 
            array (
                'id' => 1,
                'scope_id' => 1,
                'name' => '{"en":"Legend","ru":"Легенда"}',
                'desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-06 05:07:52',
                'updated_at' => '2022-11-06 06:49:10',
            ),
        ));
        
        
    }
}