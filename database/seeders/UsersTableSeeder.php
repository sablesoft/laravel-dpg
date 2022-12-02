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
                'remember_token' => '71Q7ddWnjNT2c4bB52yEGh1d0vuM4TNTgQNd4uCBn4aI849OQ735CoanG2SR',
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
                'language_id' => 2,
                'remember_token' => 'xLJh6Q7HJ5JrvLbUZOh83mpIQzrxWBVD7gi34eJQo1JSmAnZ2B1I3o1Ex22E',
                'created_at' => '2022-11-06 05:05:12',
                'updated_at' => '2022-12-02 02:53:16',
            ),
        ));
        
        
    }
}