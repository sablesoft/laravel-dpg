<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdventuresTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('adventures')->delete();
        
        \DB::table('adventures')->insert(array (
            0 => 
            array (
                'id' => 1,
                'image' => '5JwWzj3NJfN0etCZb1ZPxSk3jLaggQNqWrxlgpxA.jpg',
                'name' => '{"en":"Totem Quest","ru":"Поиски Тотема"}',
                'desc' => '{"en":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-06 05:07:24',
                'updated_at' => '2022-11-08 12:31:57',
            ),
        ));
        
        
    }
}