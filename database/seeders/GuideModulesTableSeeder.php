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
        ));
        
        
    }
}