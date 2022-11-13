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
                'id' => 2,
                'book_id' => 1,
                'card_id' => 19,
                'scope_id' => 13,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:50:38',
                'updated_at' => '2022-11-12 16:50:38',
            ),
            1 => 
            array (
                'id' => 4,
                'book_id' => 1,
                'card_id' => 52,
                'scope_id' => 22,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:51:25',
                'updated_at' => '2022-11-12 16:51:25',
            ),
            2 => 
            array (
                'id' => 6,
                'book_id' => 1,
                'card_id' => 16,
                'scope_id' => 13,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:51:51',
                'updated_at' => '2022-11-12 16:51:51',
            ),
            3 => 
            array (
                'id' => 7,
                'book_id' => 1,
                'card_id' => 21,
                'scope_id' => 13,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:52:51',
                'updated_at' => '2022-11-12 16:52:51',
            ),
            4 => 
            array (
                'id' => 9,
                'book_id' => 1,
                'card_id' => 6,
                'scope_id' => 12,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:53:21',
                'updated_at' => '2022-11-12 16:53:21',
            ),
            5 => 
            array (
                'id' => 11,
                'book_id' => 1,
                'card_id' => 36,
                'scope_id' => 16,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:54:20',
                'updated_at' => '2022-11-12 16:54:20',
            ),
            6 => 
            array (
                'id' => 12,
                'book_id' => 1,
                'card_id' => 4,
                'scope_id' => 12,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:55:00',
                'updated_at' => '2022-11-12 16:55:00',
            ),
            7 => 
            array (
                'id' => 13,
                'book_id' => 1,
                'card_id' => 20,
                'scope_id' => 13,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:55:11',
                'updated_at' => '2022-11-12 16:55:11',
            ),
            8 => 
            array (
                'id' => 14,
                'book_id' => 1,
                'card_id' => 10,
                'scope_id' => 11,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:55:49',
                'updated_at' => '2022-11-12 16:55:49',
            ),
            9 => 
            array (
                'id' => 15,
                'book_id' => 1,
                'card_id' => 27,
                'scope_id' => 13,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:59:05',
                'updated_at' => '2022-11-12 16:59:05',
            ),
            10 => 
            array (
                'id' => 16,
                'book_id' => 1,
                'card_id' => 41,
                'scope_id' => 3,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:59:22',
                'updated_at' => '2022-11-13 02:05:23',
            ),
            11 => 
            array (
                'id' => 17,
                'book_id' => 1,
                'card_id' => 61,
                'scope_id' => 63,
                'desc' => '{"en":"Because of its large size, the green anaconda is cumbersome on land but stealthy in the water. It spends most of its time underwater waiting for prey, but on occasion waits in the trees and drops down to surprise prey. Its preferred habitats are slow-moving rivers, flooded forest floors, and swamps."}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-13 02:34:11',
                'updated_at' => '2022-11-13 02:36:21',
            ),
            12 => 
            array (
                'id' => 18,
                'book_id' => 1,
                'card_id' => 61,
                'scope_id' => 64,
                'desc' => '{"en":"Green anacondas feed on large rodents, deer, fish, peccaries, capybaras, tapirs, turtles, birds, dogs, sheep, aquatic reptiles like caiman, and even jaguars. After asphyxiating their prey, they are able to unhinge their jaws to swallow their prey head-first and whole, regardless of size. Their large meals can take time to digest, allowing them to go weeks or even months without feeding. Young anacondas feed on small rodents, chicks, frogs, and fish."}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-13 02:38:47',
                'updated_at' => '2022-11-13 02:39:25',
            ),
            13 => 
            array (
                'id' => 19,
                'book_id' => 1,
                'card_id' => 53,
                'scope_id' => 63,
                'desc' => '{"en":"Capybaras have partially webbed feet, which help to propel them through the water or swampy areas. Similar to a hippopotamus, the capybara’s eyes, nose, and ears are located on the top of its head, allowing it to peek above the surface for a breath of air and a quick check for predators while the bulk of its body remains hidden beneath the water.\\r\\n\\r\\nThey are semi-aquatic and will spend most of their time in dense vegetation around rivers, lakes, ponds, marshes, and swamps."}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-13 02:42:02',
                'updated_at' => '2022-11-13 02:44:13',
            ),
            14 => 
            array (
                'id' => 5,
                'book_id' => 1,
                'card_id' => 53,
                'scope_id' => 22,
                'desc' => '{"en":"Capybaras are naturally threatened by jaguars, caimans and anacondas, and their young can be taken by ocelots and harpy eagles."}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:51:37',
                'updated_at' => '2022-11-13 02:56:34',
            ),
            15 => 
            array (
                'id' => 10,
                'book_id' => 1,
                'card_id' => 51,
                'scope_id' => 64,
                'desc' => '{"en":"Jaguars are known to eat more than 85 species of prey, including armadillos, peccaries, capybaras, tapir, deer, squirrels, birds, and even snails. Not confined to hunting on land, jaguars are adept at snatching fish, turtles, and young caiman from the water. They are even able to hunt monkeys and other tree-dwellers who occasionally wander to lower branches."}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-12 16:53:38',
                'updated_at' => '2022-11-13 02:58:34',
            ),
            16 => 
            array (
                'id' => 20,
                'book_id' => 1,
                'card_id' => 51,
                'scope_id' => 63,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-13 02:59:59',
                'updated_at' => '2022-11-13 02:59:59',
            ),
            17 => 
            array (
                'id' => 21,
                'book_id' => 1,
                'card_id' => 51,
                'scope_id' => 22,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-13 03:03:22',
                'updated_at' => '2022-11-13 03:03:22',
            ),
            18 => 
            array (
                'id' => 22,
                'book_id' => 1,
                'card_id' => 54,
                'scope_id' => 63,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-13 03:11:38',
                'updated_at' => '2022-11-13 03:11:38',
            ),
            19 => 
            array (
                'id' => 23,
                'book_id' => 1,
                'card_id' => 49,
                'scope_id' => 63,
                'desc' => '{"en":"They prefer to spend their time in tall, deciduous trees in forests and near rivers, usually in large, noisy groups."}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-13 03:13:42',
                'updated_at' => '2022-11-13 03:14:56',
            ),
            20 => 
            array (
                'id' => 24,
                'book_id' => 1,
                'card_id' => 69,
                'scope_id' => 22,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'created_at' => '2022-11-13 19:41:38',
                'updated_at' => '2022-11-13 19:41:38',
            ),
        ));
        
        
    }
}