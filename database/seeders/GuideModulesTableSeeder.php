<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GuideModulesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('guide_modules')->delete();
        
        \DB::table('guide_modules')->insert(array (
            0 => 
            array (
                'id' => 3,
                'owner_id' => 1,
                'project_id' => 1,
                'type_id' => 14,
                'topic_id' => 79,
                'number' => 1,
                'created_at' => '2023-04-27 03:05:31',
                'updated_at' => '2023-04-27 03:05:31',
            ),
            1 => 
            array (
                'id' => 4,
                'owner_id' => 1,
                'project_id' => 1,
                'type_id' => 14,
                'topic_id' => 45,
                'number' => 2,
                'created_at' => '2023-04-27 17:16:43',
                'updated_at' => '2023-04-27 17:16:43',
            ),
            2 => 
            array (
                'id' => 5,
                'owner_id' => 1,
                'project_id' => 1,
                'type_id' => 14,
                'topic_id' => 49,
                'number' => 3,
                'created_at' => '2023-04-27 17:19:42',
                'updated_at' => '2023-04-27 17:19:42',
            ),
            3 => 
            array (
                'id' => 6,
                'owner_id' => 1,
                'project_id' => 1,
                'type_id' => 1,
                'topic_id' => 17,
                'number' => 1,
                'created_at' => '2023-04-27 17:28:35',
                'updated_at' => '2023-04-27 17:28:35',
            ),
            4 => 
            array (
                'id' => 7,
                'owner_id' => 1,
                'project_id' => 1,
                'type_id' => 14,
                'topic_id' => 51,
                'number' => 4,
                'created_at' => '2023-04-27 17:30:09',
                'updated_at' => '2023-04-27 17:30:09',
            ),
            5 => 
            array (
                'id' => 8,
                'owner_id' => 1,
                'project_id' => 1,
                'type_id' => 14,
                'topic_id' => 47,
                'number' => 5,
                'created_at' => '2023-04-27 17:32:29',
                'updated_at' => '2023-04-27 17:32:29',
            ),
            6 => 
            array (
                'id' => 9,
                'owner_id' => 1,
                'project_id' => 1,
                'type_id' => 14,
                'topic_id' => 46,
                'number' => 6,
                'created_at' => '2023-04-27 17:45:48',
                'updated_at' => '2023-04-27 17:45:48',
            ),
            7 => 
            array (
                'id' => 10,
                'owner_id' => 1,
                'project_id' => 1,
                'type_id' => 14,
                'topic_id' => 48,
                'number' => 7,
                'created_at' => '2023-04-27 17:45:59',
                'updated_at' => '2023-04-27 17:45:59',
            ),
            8 => 
            array (
                'id' => 11,
                'owner_id' => 1,
                'project_id' => 1,
                'type_id' => 14,
                'topic_id' => 50,
                'number' => 8,
                'created_at' => '2023-04-27 17:46:11',
                'updated_at' => '2023-04-27 17:46:11',
            ),
        ));
        
        
    }
}