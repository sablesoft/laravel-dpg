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
                'id' => 3,
                'topic_id' => 87,
                'post_id' => 59,
                'project_id' => 1,
                'owner_id' => 1,
                'created_at' => '2023-04-19 21:56:22',
                'updated_at' => '2023-04-19 21:56:24',
            ),
            3 => 
            array (
                'id' => 5,
                'topic_id' => 56,
                'post_id' => 61,
                'project_id' => 1,
                'owner_id' => 1,
                'created_at' => '2023-04-20 02:25:51',
                'updated_at' => '2023-04-20 02:25:51',
            ),
        ));
        
        
    }
}