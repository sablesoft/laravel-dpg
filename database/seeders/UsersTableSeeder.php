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
                'id' => 2,
                'name' => '{"en":"Test"}',
                'image' => NULL,
                'email' => 'test@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$rUke3HZ0PtOZyhsukkDBWOdMS8zAdFmdCMxGEjxXUbftHtCD46gHq',
                'language_id' => 1,
                'remember_token' => 'ijhd4ZYISH2GQtWluWNXBKNABVlEk47V2oFjpdZlTDacnyLzpURdJlpHlVPp',
                'created_at' => '2022-11-08 23:12:13',
                'updated_at' => '2022-11-08 23:57:43',
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
                'remember_token' => 'epLwYbVPPJVvdbhLWtwBi3rpBLxq9ETyiWeVsrnwCeCJLoYKq8HLyKhqqwJ4',
                'created_at' => '2022-11-06 05:05:12',
                'updated_at' => '2022-11-21 21:37:51',
            ),
        ));
        
        
    }
}