<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DecksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('decks')->delete();
        
        \DB::table('decks')->insert(array (
            0 => 
            array (
                'id' => 11,
                'book_id' => 1,
                'card_id' => 36,
                'scope_id' => 16,
                'type' => 0,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:54:20',
                'updated_at' => '2022-11-12 16:54:20',
            ),
            1 => 
            array (
                'id' => 25,
                'book_id' => 1,
                'card_id' => 35,
                'scope_id' => 41,
                'type' => 0,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-15 17:05:57',
                'updated_at' => '2022-11-15 17:05:57',
            ),
            2 => 
            array (
                'id' => 30,
                'book_id' => 1,
                'card_id' => 35,
                'scope_id' => 13,
                'type' => 0,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-15 21:04:44',
                'updated_at' => '2022-11-15 21:04:44',
            ),
            3 => 
            array (
                'id' => 31,
                'book_id' => 1,
                'card_id' => 35,
                'scope_id' => 19,
                'type' => 0,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-15 21:42:11',
                'updated_at' => '2022-11-15 21:42:11',
            ),
            4 => 
            array (
                'id' => 32,
                'book_id' => 1,
                'card_id' => 35,
                'scope_id' => 20,
                'type' => 0,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-16 02:03:36',
                'updated_at' => '2022-11-16 02:03:36',
            ),
            5 => 
            array (
                'id' => 34,
                'book_id' => 1,
                'card_id' => 35,
                'scope_id' => 27,
                'type' => 0,
                'desc' => '{"en":"The spirits of the Rainforest are everywhere. You can communicate with them and get help from them. But be afraid to anger them!"}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-16 02:45:10',
                'updated_at' => '2022-11-16 02:45:10',
            ),
            6 => 
            array (
                'id' => 38,
                'book_id' => 1,
                'card_id' => 55,
                'scope_id' => 80,
                'type' => 1,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-16 03:11:57',
                'updated_at' => '2022-11-16 12:54:18',
            ),
            7 => 
            array (
                'id' => 37,
                'book_id' => 1,
                'card_id' => 55,
                'scope_id' => 82,
                'type' => 1,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-16 03:05:29',
                'updated_at' => '2022-11-16 12:54:34',
            ),
            8 => 
            array (
                'id' => 36,
                'book_id' => 1,
                'card_id' => 55,
                'scope_id' => 81,
                'type' => 1,
                'desc' => '{"en":"The skill level of taming different creatures is different."}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-16 02:59:57',
                'updated_at' => '2022-11-16 12:54:48',
            ),
            9 => 
            array (
                'id' => 35,
                'book_id' => 1,
                'card_id' => 55,
                'scope_id' => 79,
                'type' => 1,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-16 02:51:06',
                'updated_at' => '2022-11-16 12:55:07',
            ),
            10 => 
            array (
                'id' => 20,
                'book_id' => 1,
                'card_id' => 51,
                'scope_id' => 63,
                'type' => 1,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-13 02:59:59',
                'updated_at' => '2022-11-16 13:03:58',
            ),
            11 => 
            array (
                'id' => 29,
                'book_id' => 1,
                'card_id' => 55,
                'scope_id' => 16,
                'type' => 1,
                'desc' => '{"en":"Each character has specifications. Use this card as a character scope to list them."}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-15 17:53:59',
                'updated_at' => '2022-11-16 12:56:17',
            ),
            12 => 
            array (
                'id' => 28,
                'book_id' => 1,
                'card_id' => 55,
                'scope_id' => 73,
                'type' => 1,
                'desc' => '{"en":"Damage to the hero"}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-15 17:44:56',
                'updated_at' => '2022-11-16 12:56:35',
            ),
            13 => 
            array (
                'id' => 19,
                'book_id' => 1,
                'card_id' => 53,
                'scope_id' => 63,
                'type' => 1,
                'desc' => '{"en":"Capybaras have partially webbed feet, which help to propel them through the water or swampy areas. Similar to a hippopotamus, the capybara’s eyes, nose, and ears are located on the top of its head, allowing it to peek above the surface for a breath of air and a quick check for predators while the bulk of its body remains hidden beneath the water.\\r\\n\\r\\nThey are semi-aquatic and will spend most of their time in dense vegetation around rivers, lakes, ponds, marshes, and swamps."}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-13 02:42:02',
                'updated_at' => '2022-11-16 13:04:24',
            ),
            14 => 
            array (
                'id' => 18,
                'book_id' => 1,
                'card_id' => 61,
                'scope_id' => 64,
                'type' => 1,
                'desc' => '{"en":"Green anacondas feed on large rodents, deer, fish, peccaries, capybaras, tapirs, turtles, birds, dogs, sheep, aquatic reptiles like caiman, and even jaguars. After asphyxiating their prey, they are able to unhinge their jaws to swallow their prey head-first and whole, regardless of size. Their large meals can take time to digest, allowing them to go weeks or even months without feeding. Young anacondas feed on small rodents, chicks, frogs, and fish."}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-13 02:38:47',
                'updated_at' => '2022-11-16 13:04:45',
            ),
            15 => 
            array (
                'id' => 17,
                'book_id' => 1,
                'card_id' => 61,
                'scope_id' => 63,
                'type' => 1,
                'desc' => '{"en":"Because of its large size, the green anaconda is cumbersome on land but stealthy in the water. It spends most of its time underwater waiting for prey, but on occasion waits in the trees and drops down to surprise prey. Its preferred habitats are slow-moving rivers, flooded forest floors, and swamps."}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-13 02:34:11',
                'updated_at' => '2022-11-16 13:05:07',
            ),
            16 => 
            array (
                'id' => 22,
                'book_id' => 1,
                'card_id' => 54,
                'scope_id' => 63,
                'type' => 1,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-13 03:11:38',
                'updated_at' => '2022-11-16 13:02:18',
            ),
            17 => 
            array (
                'id' => 33,
                'book_id' => 1,
                'card_id' => 77,
                'scope_id' => 22,
                'type' => 1,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-16 02:34:21',
                'updated_at' => '2022-11-16 13:02:35',
            ),
            18 => 
            array (
                'id' => 24,
                'book_id' => 1,
                'card_id' => 69,
                'scope_id' => 22,
                'type' => 1,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-13 19:41:38',
                'updated_at' => '2022-11-16 13:03:07',
            ),
            19 => 
            array (
                'id' => 23,
                'book_id' => 1,
                'card_id' => 49,
                'scope_id' => 63,
                'type' => 1,
                'desc' => '{"en":"They prefer to spend their time in tall, deciduous trees in forests and near rivers, usually in large, noisy groups."}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-13 03:13:42',
                'updated_at' => '2022-11-16 13:03:23',
            ),
            20 => 
            array (
                'id' => 21,
                'book_id' => 1,
                'card_id' => 51,
                'scope_id' => 22,
                'type' => 1,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-13 03:03:22',
                'updated_at' => '2022-11-16 13:03:40',
            ),
            21 => 
            array (
                'id' => 10,
                'book_id' => 1,
                'card_id' => 51,
                'scope_id' => 64,
                'type' => 1,
                'desc' => '{"en":"Jaguars are known to eat more than 85 species of prey, including armadillos, peccaries, capybaras, tapir, deer, squirrels, birds, and even snails. Not confined to hunting on land, jaguars are adept at snatching fish, turtles, and young caiman from the water. They are even able to hunt monkeys and other tree-dwellers who occasionally wander to lower branches."}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:53:38',
                'updated_at' => '2022-11-16 13:05:45',
            ),
            22 => 
            array (
                'id' => 5,
                'book_id' => 1,
                'card_id' => 53,
                'scope_id' => 22,
                'type' => 1,
                'desc' => '{"en":"Capybaras are naturally threatened by jaguars, caimans and anacondas, and their young can be taken by ocelots and harpy eagles."}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:51:37',
                'updated_at' => '2022-11-16 13:06:07',
            ),
            23 => 
            array (
                'id' => 4,
                'book_id' => 1,
                'card_id' => 52,
                'scope_id' => 22,
                'type' => 1,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:51:25',
                'updated_at' => '2022-11-16 13:06:24',
            ),
            24 => 
            array (
                'id' => 27,
                'book_id' => 1,
                'card_id' => 55,
                'scope_id' => 4,
                'type' => 2,
                'desc' => '{"en":"The place where our hero is located. Always one card."}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-15 17:39:14',
                'updated_at' => '2022-11-16 12:59:02',
            ),
            25 => 
            array (
                'id' => 26,
                'book_id' => 1,
                'card_id' => 55,
                'scope_id' => 42,
                'type' => 1,
                'desc' => '{"en":"Our hero begins his adventure with a certain set of knowledge and continues to accumulate them."}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-15 17:36:23',
                'updated_at' => '2022-11-16 13:18:27',
            ),
        ));
        
        
    }
}