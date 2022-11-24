<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('languages')->delete();
        
        \DB::table('languages')->insert(array (
            0 => 
            array (
                'id' => 2,
                'code' => 'ru',
                'name' => '{"en":"Russian","ru":"Русский"}',
                'created_at' => '2022-11-06 05:06:46',
                'updated_at' => '2022-11-06 05:35:21',
            ),
            1 => 
            array (
                'id' => 1,
                'code' => 'en',
                'name' => '{"en":"English","ru":"Английский"}',
                'created_at' => '2022-11-06 05:05:48',
                'updated_at' => '2022-11-06 05:35:33',
            ),
            2 => 
            array (
                'id' => 3,
                'code' => 'pt',
                'name' => '{"en":"Portugues","ru":"Португальский"}',
                'created_at' => '2022-11-24 14:26:30',
                'updated_at' => '2022-11-24 14:26:48',
            ),
        ));
        
        
    }
}