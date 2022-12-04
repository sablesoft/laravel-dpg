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
                'name' => '{"en":"Rainforest\'s Heart"}',
                'code' => NULL,
                'scope_id' => NULL,
                'dome_id' => 2,
                'card_id' => 99,
                'top_step' => 13,
                'top' => 4010,
                'left_step' => 27,
                'left' => 4800,
                'markers' => NULL,
                'image' => 'area/fZQpsLUeh9eNiu14kiGnKAZ6RCp0d69nbXsEagy6.png',
                'desc' => '{"en":null}',
                'is_public' => false,
                'owner_id' => 1,
                'created_at' => '2022-12-04 16:05:21',
                'updated_at' => '2022-12-04 17:15:05',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '{"en":"River of Birth"}',
                'code' => NULL,
                'scope_id' => NULL,
                'dome_id' => 2,
                'card_id' => 33,
                'top_step' => 13,
                'top' => 4010,
                'left_step' => 25,
                'left' => 4445,
                'markers' => NULL,
                'image' => 'area/Arja6BTO8cdVywvNdVBL4DPpoXDvZflUktu49V05.png',
                'desc' => '{"en":null}',
                'is_public' => false,
                'owner_id' => 1,
                'created_at' => '2022-12-04 07:56:45',
                'updated_at' => '2022-12-04 17:20:37',
            ),
            2 => 
            array (
                'id' => 4,
                'name' => '{"en":"Test"}',
                'code' => NULL,
                'scope_id' => NULL,
                'dome_id' => 2,
                'card_id' => 100,
                'top_step' => 13,
                'top' => 4010,
                'left_step' => 23,
                'left' => 4089,
                'markers' => NULL,
                'image' => 'area/TIsZmQavQwFokWI1MeoJ3LCE25Uj2BCztmLODO8j.png',
                'desc' => '{"en":null}',
                'is_public' => false,
                'owner_id' => 1,
                'created_at' => '2022-12-04 16:30:36',
                'updated_at' => '2022-12-04 17:24:24',
            ),
        ));
        
        
    }
}