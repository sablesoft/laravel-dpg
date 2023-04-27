<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GuideTopicModulesSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->updates() as $id => $moduleId) {
            \DB::table('guide_topics')->where('id', $id)->update(['module_id' => $moduleId]);
        }
    }

    /**
     * @return null[]
     */
    protected function updates(): array
    {
        return [
            93 => null,
        ];
    }
}
