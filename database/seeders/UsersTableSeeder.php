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
                'id' => 4,
                'name' => '{"en":"Vvrn","ru":"\\u0413\\u044b\\u0433\\u043e\\u0440\\u044c"}',
                'image' => NULL,
                'email' => 'me.vvrn@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$z64SqlsR6xnDW9uaNGQp/OHtCjsAJg25IwFSBfeqt8jgsPLIlf9S2',
                'language_id' => 2,
                'remember_token' => 'uxlvzXhxSSSuzicXUHjrno85c3Dbbc4eyn5B6da8XdkHBTVc3lcEibAxu1VJ',
                'created_at' => '2022-11-22 18:18:58',
                'updated_at' => '2022-11-22 18:29:34',
            ),
            1 => 
            array (
                'id' => 1,
                'name' => '{"ru":"\\u0420\\u043e\\u043c\\u0430\\u043d","en":"Raman"}',
                'image' => 'UlYkl47Y3jlnCPZBUHl8iQHMBuF35rg52Q812wPk.jpg',
                'email' => 'sable.lair@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$tqFq6LC1Vniwd30udVbFi.WzT.rsKmrVvUa6rM/4/fbbcrNEWN0hW',
                'language_id' => 1,
                'remember_token' => '00wBIiL4AAiyGsJsN0fxzmT5N7nXDOLfGWdY5RKE3utGTVu9L9RrtvzllXtm',
                'created_at' => '2022-11-06 05:05:12',
                'updated_at' => '2022-11-22 22:48:57',
            ),
        ));
        
        
    }
}