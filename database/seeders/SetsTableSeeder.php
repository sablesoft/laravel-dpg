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
                'id' => 66,
                'game_id' => 1,
                'deck_id' => 42,
                'card_id' => 49,
                'scope_id' => 15,
                'owner_id' => 1,
                'desc' => '',
                'created_at' => '2022-12-02 02:39:45',
                'updated_at' => '2022-12-02 02:39:45',
            ),
            1 => 
            array (
                'id' => 67,
                'game_id' => 1,
                'deck_id' => 21,
                'card_id' => 51,
                'scope_id' => 22,
                'owner_id' => 1,
                'desc' => '',
                'created_at' => '2022-12-02 02:39:45',
                'updated_at' => '2022-12-02 02:39:45',
            ),
            2 => 
            array (
                'id' => 68,
                'game_id' => 1,
                'deck_id' => 10,
                'card_id' => 51,
                'scope_id' => 64,
                'owner_id' => 1,
                'desc' => 'Jaguars are known to eat more than 85 species of prey, including armadillos, peccaries, capybaras, tapir, deer, squirrels, birds, and even snails. Not confined to hunting on land, jaguars are adept at snatching fish, turtles, and young caiman from the water. They are even able to hunt monkeys and other tree-dwellers who occasionally wander to lower branches.',
                'created_at' => '2022-12-02 02:39:45',
                'updated_at' => '2022-12-02 02:39:45',
            ),
            3 => 
            array (
                'id' => 70,
                'game_id' => 1,
                'deck_id' => 44,
                'card_id' => 51,
                'scope_id' => 15,
                'owner_id' => 1,
                'desc' => '',
                'created_at' => '2022-12-02 02:39:45',
                'updated_at' => '2022-12-02 02:39:45',
            ),
            4 => 
            array (
                'id' => 71,
                'game_id' => 1,
                'deck_id' => 4,
                'card_id' => 52,
                'scope_id' => 22,
                'owner_id' => 1,
                'desc' => '',
                'created_at' => '2022-12-02 02:39:45',
                'updated_at' => '2022-12-02 02:39:45',
            ),
            5 => 
            array (
                'id' => 72,
                'game_id' => 1,
                'deck_id' => 5,
                'card_id' => 53,
                'scope_id' => 22,
                'owner_id' => 1,
                'desc' => 'Capybaras are naturally threatened by jaguars, caimans and anacondas, and their young can be taken by ocelots and harpy eagles.',
                'created_at' => '2022-12-02 02:39:45',
                'updated_at' => '2022-12-02 02:39:45',
            ),
            6 => 
            array (
                'id' => 73,
                'game_id' => 1,
                'deck_id' => 19,
                'card_id' => 53,
                'scope_id' => 14,
                'owner_id' => 1,
                'desc' => 'Capybaras have partially webbed feet, which help to propel them through the water or swampy areas. Similar to a hippopotamus, the capybara’s eyes, nose, and ears are located on the top of its head, allowing it to peek above the surface for a breath of air and a quick check for predators while the bulk of its body remains hidden beneath the water.

They are semi-aquatic and will spend most of their time in dense vegetation around rivers, lakes, ponds, marshes, and swamps.',
                'created_at' => '2022-12-02 02:39:45',
                'updated_at' => '2022-12-02 02:39:45',
            ),
            7 => 
            array (
                'id' => 76,
                'game_id' => 1,
                'deck_id' => 43,
                'card_id' => 54,
                'scope_id' => 15,
                'owner_id' => 1,
                'desc' => '',
                'created_at' => '2022-12-02 02:39:45',
                'updated_at' => '2022-12-02 02:39:45',
            ),
            8 => 
            array (
                'id' => 77,
                'game_id' => 1,
                'deck_id' => 29,
                'card_id' => 80,
                'scope_id' => 8,
                'owner_id' => 1,
                'desc' => 'Each character has specifications. Use this card as a character scope to list them.',
                'created_at' => '2022-12-02 02:39:45',
                'updated_at' => '2022-12-02 02:39:45',
            ),
            9 => 
            array (
                'id' => 78,
                'game_id' => 1,
                'deck_id' => 26,
                'card_id' => 80,
                'scope_id' => 42,
                'owner_id' => 1,
                'desc' => 'Our hero begins his adventure with a certain set of knowledge and continues to accumulate them.',
                'created_at' => '2022-12-02 02:39:45',
                'updated_at' => '2022-12-02 02:39:45',
            ),
            10 => 
            array (
                'id' => 79,
                'game_id' => 1,
                'deck_id' => 28,
                'card_id' => 80,
                'scope_id' => 73,
                'owner_id' => 1,
                'desc' => 'Damage to the hero',
                'created_at' => '2022-12-02 02:39:45',
                'updated_at' => '2022-12-02 02:39:45',
            ),
            11 => 
            array (
                'id' => 80,
                'game_id' => 1,
                'deck_id' => 35,
                'card_id' => 80,
                'scope_id' => 11,
                'owner_id' => 1,
                'desc' => '',
                'created_at' => '2022-12-02 02:39:45',
                'updated_at' => '2022-12-02 02:39:45',
            ),
            12 => 
            array (
                'id' => 81,
                'game_id' => 1,
                'deck_id' => 38,
                'card_id' => 80,
                'scope_id' => 55,
                'owner_id' => 1,
                'desc' => '',
                'created_at' => '2022-12-02 02:39:45',
                'updated_at' => '2022-12-02 02:39:45',
            ),
            13 => 
            array (
                'id' => 82,
                'game_id' => 1,
                'deck_id' => 36,
                'card_id' => 80,
                'scope_id' => 81,
                'owner_id' => 1,
                'desc' => 'The skill level of taming different creatures is different.',
                'created_at' => '2022-12-02 02:39:45',
                'updated_at' => '2022-12-02 02:39:45',
            ),
            14 => 
            array (
                'id' => 83,
                'game_id' => 1,
                'deck_id' => 37,
                'card_id' => 80,
                'scope_id' => 82,
                'owner_id' => 1,
                'desc' => '',
                'created_at' => '2022-12-02 02:39:45',
                'updated_at' => '2022-12-02 02:39:45',
            ),
            15 => 
            array (
                'id' => 84,
                'game_id' => 1,
                'deck_id' => 18,
                'card_id' => 61,
                'scope_id' => 64,
                'owner_id' => 1,
                'desc' => 'Green anacondas feed on large rodents, deer, fish, peccaries, capybaras, tapirs, turtles, birds, dogs, sheep, aquatic reptiles like caiman, and even jaguars. After asphyxiating their prey, they are able to unhinge their jaws to swallow their prey head-first and whole, regardless of size. Their large meals can take time to digest, allowing them to go weeks or even months without feeding. Young anacondas feed on small rodents, chicks, frogs, and fish.',
                'created_at' => '2022-12-02 02:39:46',
                'updated_at' => '2022-12-02 02:39:46',
            ),
            16 => 
            array (
                'id' => 86,
                'game_id' => 1,
                'deck_id' => 46,
                'card_id' => 61,
                'scope_id' => 15,
                'owner_id' => 1,
                'desc' => '',
                'created_at' => '2022-12-02 02:39:46',
                'updated_at' => '2022-12-02 02:39:46',
            ),
            17 => 
            array (
                'id' => 87,
                'game_id' => 1,
                'deck_id' => 24,
                'card_id' => 69,
                'scope_id' => 22,
                'owner_id' => 1,
                'desc' => '',
                'created_at' => '2022-12-02 02:39:46',
                'updated_at' => '2022-12-02 02:39:46',
            ),
            18 => 
            array (
                'id' => 88,
                'game_id' => 1,
                'deck_id' => 33,
                'card_id' => 77,
                'scope_id' => 22,
                'owner_id' => 1,
                'desc' => '',
                'created_at' => '2022-12-02 02:39:46',
                'updated_at' => '2022-12-02 02:39:46',
            ),
        ));
        
        
    }
}