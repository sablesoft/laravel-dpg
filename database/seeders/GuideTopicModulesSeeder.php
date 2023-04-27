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
            35 => 8,
            54 => 8,
            33 => 5,
            23 => 5,
            22 => 5,
            5 => 4,
            40 => 8,
            32 => 5,
            21 => 10,
            55 => 3,
            34 => 5,
            38 => 7,
            41 => 9,
            36 => 11,
            17 => 6,
            24 => 5,
            70 => 4,
            81 => 4,
            82 => 4,
            86 => 8,
        ];
    }
}
