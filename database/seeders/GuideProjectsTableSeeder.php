<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GuideProjectsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('guide_projects')->delete();
        
        \DB::table('guide_projects')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Perception Conundrum',
                'code' => 'PRC',
                'text' => 'Моя задумка - создать карточную настольную игру с глубоким сюжетом и идеей.',
                'owner_id' => 1,
                'created_at' => '2023-04-06 17:56:45',
                'updated_at' => '2023-04-08 16:41:15',
            ),
        ));
        
        
    }
}