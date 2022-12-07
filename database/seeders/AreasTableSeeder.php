<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('areas')->delete();

        \DB::table('areas')->insert(array (
            0 =>
            array (
                'id' => 3,
                'name' => '{"en":"Savanna Tract"}',
                'code' => NULL,
                'scope_id' => NULL,
                'dome_id' => 1,
                'card_id' => 23,
                'top_step' => 13,
                'top' => 3810,
                'left_step' => 16,
                'left' => 2703,
                'markers' => NULL,
                'image' => 'area/muP5RRJ4biUVRVvfCLw9rs6tgqj8PNOdetsfJlfX.png',
                'desc' => '{"en":null}',
                'is_public' => false,
                'owner_id' => 1,
                'created_at' => '2022-12-04 16:30:36',
                'updated_at' => '2022-12-04 20:18:18',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => '{"en":"Deep Forest"}',
                'code' => NULL,
                'scope_id' => NULL,
                'dome_id' => 1,
                'card_id' => 32,
                'top_step' => 13,
                'top' => 3809,
                'left_step' => 20,
                'left' => 3378,
                'markers' => NULL,
                'image' => 'area/6LkWTYFliWvntlsZwZ3MUER9FVZRPaezJpE57Mwb.png',
                'desc' => '{"en":null}',
                'is_public' => false,
                'owner_id' => 1,
                'created_at' => '2022-12-04 16:05:21',
                'updated_at' => '2022-12-04 20:25:07',
            ),
            2 =>
            array (
                'id' => 1,
                'name' => '{"en":"River of Birth","ru":"Река Рождения"}',
                'code' => NULL,
                'scope_id' => NULL,
                'dome_id' => 1,
                'card_id' => 33,
                'top_step' => 13,
                'top' => 3809,
                'left_step' => 18,
                'left' => 3042,
                'markers' => NULL,
                'image' => 'area/ajSwLaeERJgJRdMdZqwrff9TSj47iQujPk2wgWRD.png',
                'desc' => '{"ru":null}',
                'is_public' => false,
                'owner_id' => 1,
                'created_at' => '2022-12-04 07:56:45',
                'updated_at' => '2022-12-04 20:35:34',
            ),
        ));


    }
}
