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
            57 => 3,
            72 => 3,
            73 => 3,
            75 => 3,
            69 => 3,
            104 => 3,
            97 => 3,
            98 => 3,
            103 => 3,
            105 => 3,
        ];
    }
}
