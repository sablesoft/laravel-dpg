<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GuideTagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('guide_tags')->delete();
        
        \DB::table('guide_tags')->insert(array (
            0 => 
            array (
                'id' => 1,
                'topic_id' => 56,
                'post_id' => 57,
                'project_id' => 1,
                'owner_id' => 1,
                'created_at' => '2023-04-19 21:48:15',
                'updated_at' => '2023-04-19 21:48:16',
            ),
            1 => 
            array (
                'id' => 2,
                'topic_id' => 56,
                'post_id' => 60,
                'project_id' => 1,
                'owner_id' => 1,
                'created_at' => '2023-04-19 21:54:59',
                'updated_at' => '2023-04-19 21:55:00',
            ),
            2 => 
            array (
                'id' => 5,
                'topic_id' => 56,
                'post_id' => 61,
                'project_id' => 1,
                'owner_id' => 1,
                'created_at' => '2023-04-20 02:25:51',
                'updated_at' => '2023-04-20 02:25:51',
            ),
            3 => 
            array (
                'id' => 6,
                'topic_id' => 56,
                'post_id' => 62,
                'project_id' => 1,
                'owner_id' => 1,
                'created_at' => '2023-04-21 01:46:24',
                'updated_at' => '2023-04-21 01:46:24',
            ),
            4 => 
            array (
                'id' => 7,
                'topic_id' => 56,
                'post_id' => 59,
                'project_id' => 1,
                'owner_id' => 1,
                'created_at' => '2023-04-21 01:48:32',
                'updated_at' => '2023-04-21 01:48:32',
            ),
            5 => 
            array (
                'id' => 8,
                'topic_id' => 87,
                'post_id' => 59,
                'project_id' => 1,
                'owner_id' => 1,
                'created_at' => '2023-04-21 02:22:08',
                'updated_at' => '2023-04-21 02:22:08',
            ),
            6 => 
            array (
                'id' => 9,
                'topic_id' => 87,
                'post_id' => 62,
                'project_id' => 1,
                'owner_id' => 1,
                'created_at' => '2023-04-21 02:22:32',
                'updated_at' => '2023-04-21 02:22:32',
            ),
            7 => 
            array (
                'id' => 11,
                'topic_id' => 26,
                'post_id' => 72,
                'project_id' => 1,
                'owner_id' => 1,
                'created_at' => '2023-04-22 00:39:31',
                'updated_at' => '2023-04-22 00:39:31',
            ),
            8 => 
            array (
                'id' => 12,
                'topic_id' => 56,
                'post_id' => 72,
                'project_id' => 1,
                'owner_id' => 1,
                'created_at' => '2023-04-22 00:46:30',
                'updated_at' => '2023-04-22 00:46:30',
            ),
            9 => 
            array (
                'id' => 13,
                'topic_id' => 56,
                'post_id' => 73,
                'project_id' => 1,
                'owner_id' => 1,
                'created_at' => '2023-04-22 01:19:32',
                'updated_at' => '2023-04-22 01:19:32',
            ),
            10 => 
            array (
                'id' => 14,
                'topic_id' => 56,
                'post_id' => 74,
                'project_id' => 1,
                'owner_id' => 1,
                'created_at' => '2023-04-22 01:46:20',
                'updated_at' => '2023-04-22 01:46:20',
            ),
            11 => 
            array (
                'id' => 15,
                'topic_id' => 56,
                'post_id' => 76,
                'project_id' => 1,
                'owner_id' => 1,
                'created_at' => '2023-04-26 02:27:59',
                'updated_at' => '2023-04-26 02:27:59',
            ),
            12 => 
            array (
                'id' => 16,
                'topic_id' => 26,
                'post_id' => 80,
                'project_id' => 1,
                'owner_id' => 1,
                'created_at' => '2023-04-27 15:28:16',
                'updated_at' => '2023-04-27 15:28:16',
            ),
            13 => 
            array (
                'id' => 17,
                'topic_id' => 101,
                'post_id' => 81,
                'project_id' => 1,
                'owner_id' => 1,
                'created_at' => '2023-04-27 15:31:24',
                'updated_at' => '2023-04-27 15:31:24',
            ),
        ));
        
        
    }
}