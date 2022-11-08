<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '{"ru":"Админ","en":"Admin"}',
                'email' => 'sable.lair@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$tqFq6LC1Vniwd30udVbFi.WzT.rsKmrVvUa6rM/4/fbbcrNEWN0hW',
                'language_id' => 1,
                'remember_token' => 'fjtvVl7wVfmPPGRCpdjmcQswOTB4crSQ6x7Mq4OmeKpF0zaXaVbLk160770q',
                'created_at' => '2022-11-06 05:05:12',
                'updated_at' => '2022-11-08 02:59:15',
            ),
        ));
        
        
    }
}