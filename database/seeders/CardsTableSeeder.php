<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CardsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cards')->delete();
        
        \DB::table('cards')->insert(array (
            0 => 
            array (
                'id' => 1,
                'scope_id' => 1,
                'name' => '{"en":"Serpent Path","ru":"Тропа Змея"}',
                'desc' => '{"en":"The wise people follow the sacred path of the Serpent. Everyone who walks this path cultivates living blood in himself. Everyone who walks this path holds on to the other in order to honor this path together.","ru":"Мудрый народ следует священной Тропе Змея. Каждый, идущий по этой тропе, взращивает в себе кровь живую. Каждый, идущий по этой тропе, держится другого чтобы вместе чтить этот путь."}',
                'private_desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-06 05:09:50',
                'updated_at' => '2022-11-06 06:47:51',
            ),
            1 => 
            array (
                'id' => 2,
                'scope_id' => 1,
                'name' => '{"en":"Eagle Nest","ru":"Орлиное Гнездо"}',
                'desc' => '{"en":"This ancient clan still lives in the depths of the unknown to this day. Finding the way to the inconspicuous is easy. But everyone who follows his own path of the heart will certainly meet him.","ru":"Этот древний клан и по сей день живет в самых недрах неизведанного. Найти дорогу к нему не просто. Но каждый, кто следует своему пути сердца однажды непременно встречается с ним"}',
                'private_desc' => 'Тест',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-06 05:16:54',
                'updated_at' => '2022-11-06 06:45:38',
            ),
        ));
        
        
    }
}