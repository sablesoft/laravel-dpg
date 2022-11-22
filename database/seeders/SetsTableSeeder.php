<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sets')->delete();
        
        \DB::table('sets')->insert(array (
            0 => 
            array (
                'id' => 1,
                'game_id' => 1,
                'deck_id' => 23,
                'card_id' => 49,
                'scope_id' => 63,
                'desc' => 'They prefer to spend their time in tall, deciduous trees in forests and near rivers, usually in large, noisy groups.',
                'created_at' => '2022-11-20 04:32:01',
                'updated_at' => '2022-11-20 04:32:01',
            ),
            1 => 
            array (
                'id' => 2,
                'game_id' => 1,
                'deck_id' => 21,
                'card_id' => 51,
                'scope_id' => 22,
                'desc' => '',
                'created_at' => '2022-11-20 04:32:01',
                'updated_at' => '2022-11-20 04:32:01',
            ),
            2 => 
            array (
                'id' => 3,
                'game_id' => 1,
                'deck_id' => 20,
                'card_id' => 51,
                'scope_id' => 63,
                'desc' => '',
                'created_at' => '2022-11-20 04:32:01',
                'updated_at' => '2022-11-20 04:32:01',
            ),
            3 => 
            array (
                'id' => 4,
                'game_id' => 1,
                'deck_id' => 10,
                'card_id' => 51,
                'scope_id' => 64,
                'desc' => 'Jaguars are known to eat more than 85 species of prey, including armadillos, peccaries, capybaras, tapir, deer, squirrels, birds, and even snails. Not confined to hunting on land, jaguars are adept at snatching fish, turtles, and young caiman from the water. They are even able to hunt monkeys and other tree-dwellers who occasionally wander to lower branches.',
                'created_at' => '2022-11-20 04:32:01',
                'updated_at' => '2022-11-20 04:32:01',
            ),
            4 => 
            array (
                'id' => 5,
                'game_id' => 1,
                'deck_id' => 4,
                'card_id' => 52,
                'scope_id' => 22,
                'desc' => '',
                'created_at' => '2022-11-20 04:32:01',
                'updated_at' => '2022-11-20 04:32:01',
            ),
            5 => 
            array (
                'id' => 6,
                'game_id' => 1,
                'deck_id' => 5,
                'card_id' => 53,
                'scope_id' => 22,
                'desc' => 'Capybaras are naturally threatened by jaguars, caimans and anacondas, and their young can be taken by ocelots and harpy eagles.',
                'created_at' => '2022-11-20 04:32:01',
                'updated_at' => '2022-11-20 04:32:01',
            ),
            6 => 
            array (
                'id' => 7,
                'game_id' => 1,
                'deck_id' => 19,
                'card_id' => 53,
                'scope_id' => 63,
                'desc' => 'Capybaras have partially webbed feet, which help to propel them through the water or swampy areas. Similar to a hippopotamus, the capybara’s eyes, nose, and ears are located on the top of its head, allowing it to peek above the surface for a breath of air and a quick check for predators while the bulk of its body remains hidden beneath the water.

They are semi-aquatic and will spend most of their time in dense vegetation around rivers, lakes, ponds, marshes, and swamps.',
                'created_at' => '2022-11-20 04:32:01',
                'updated_at' => '2022-11-20 04:32:01',
            ),
            7 => 
            array (
                'id' => 8,
                'game_id' => 1,
                'deck_id' => 22,
                'card_id' => 54,
                'scope_id' => 63,
                'desc' => '',
                'created_at' => '2022-11-20 04:32:01',
                'updated_at' => '2022-11-20 04:32:01',
            ),
            8 => 
            array (
                'id' => 9,
                'game_id' => 1,
                'deck_id' => 29,
                'card_id' => 55,
                'scope_id' => 16,
                'desc' => 'Each character has specifications. Use this card as a character scope to list them.',
                'created_at' => '2022-11-20 04:32:01',
                'updated_at' => '2022-11-20 04:32:01',
            ),
            9 => 
            array (
                'id' => 10,
                'game_id' => 1,
                'deck_id' => 26,
                'card_id' => 55,
                'scope_id' => 42,
                'desc' => 'Our hero begins his adventure with a certain set of knowledge and continues to accumulate them.',
                'created_at' => '2022-11-20 04:32:01',
                'updated_at' => '2022-11-20 04:32:01',
            ),
            10 => 
            array (
                'id' => 11,
                'game_id' => 1,
                'deck_id' => 28,
                'card_id' => 55,
                'scope_id' => 73,
                'desc' => 'Damage to the hero',
                'created_at' => '2022-11-20 04:32:01',
                'updated_at' => '2022-11-20 04:32:01',
            ),
            11 => 
            array (
                'id' => 12,
                'game_id' => 1,
                'deck_id' => 35,
                'card_id' => 55,
                'scope_id' => 79,
                'desc' => '',
                'created_at' => '2022-11-20 04:32:01',
                'updated_at' => '2022-11-20 04:32:01',
            ),
            12 => 
            array (
                'id' => 13,
                'game_id' => 1,
                'deck_id' => 38,
                'card_id' => 55,
                'scope_id' => 80,
                'desc' => '',
                'created_at' => '2022-11-20 04:32:01',
                'updated_at' => '2022-11-20 04:32:01',
            ),
            13 => 
            array (
                'id' => 14,
                'game_id' => 1,
                'deck_id' => 36,
                'card_id' => 55,
                'scope_id' => 81,
                'desc' => 'The skill level of taming different creatures is different.',
                'created_at' => '2022-11-20 04:32:01',
                'updated_at' => '2022-11-20 04:32:01',
            ),
            14 => 
            array (
                'id' => 15,
                'game_id' => 1,
                'deck_id' => 37,
                'card_id' => 55,
                'scope_id' => 82,
                'desc' => '',
                'created_at' => '2022-11-20 04:32:01',
                'updated_at' => '2022-11-20 04:32:01',
            ),
            15 => 
            array (
                'id' => 16,
                'game_id' => 1,
                'deck_id' => 17,
                'card_id' => 61,
                'scope_id' => 63,
                'desc' => 'Because of its large size, the green anaconda is cumbersome on land but stealthy in the water. It spends most of its time underwater waiting for prey, but on occasion waits in the trees and drops down to surprise prey. Its preferred habitats are slow-moving rivers, flooded forest floors, and swamps.',
                'created_at' => '2022-11-20 04:32:01',
                'updated_at' => '2022-11-20 04:32:01',
            ),
            16 => 
            array (
                'id' => 17,
                'game_id' => 1,
                'deck_id' => 18,
                'card_id' => 61,
                'scope_id' => 64,
                'desc' => 'Green anacondas feed on large rodents, deer, fish, peccaries, capybaras, tapirs, turtles, birds, dogs, sheep, aquatic reptiles like caiman, and even jaguars. After asphyxiating their prey, they are able to unhinge their jaws to swallow their prey head-first and whole, regardless of size. Their large meals can take time to digest, allowing them to go weeks or even months without feeding. Young anacondas feed on small rodents, chicks, frogs, and fish.',
                'created_at' => '2022-11-20 04:32:01',
                'updated_at' => '2022-11-20 04:32:01',
            ),
            17 => 
            array (
                'id' => 18,
                'game_id' => 1,
                'deck_id' => 24,
                'card_id' => 69,
                'scope_id' => 22,
                'desc' => '',
                'created_at' => '2022-11-20 04:32:02',
                'updated_at' => '2022-11-20 04:32:02',
            ),
            18 => 
            array (
                'id' => 19,
                'game_id' => 1,
                'deck_id' => 33,
                'card_id' => 77,
                'scope_id' => 22,
                'desc' => '',
                'created_at' => '2022-11-20 04:32:02',
                'updated_at' => '2022-11-20 04:32:02',
            ),
        ));
        
        
    }
}