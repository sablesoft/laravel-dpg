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
                'card_id' => 83,
                'scope_id' => 8,
                'type' => 0,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => 2,
                'dome_id' => NULL,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-12 16:54:20',
                'updated_at' => '2022-11-12 16:54:20',
            ),
            1 => 
            array (
                'id' => 25,
                'card_id' => 35,
                'scope_id' => 41,
                'type' => 0,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => 2,
                'dome_id' => NULL,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-15 17:05:57',
                'updated_at' => '2022-11-15 17:05:57',
            ),
            2 => 
            array (
                'id' => 30,
                'card_id' => 35,
                'scope_id' => 13,
                'type' => 0,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => 2,
                'dome_id' => NULL,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-15 21:04:44',
                'updated_at' => '2022-11-15 21:04:44',
            ),
            3 => 
            array (
                'id' => 34,
                'card_id' => 35,
                'scope_id' => 27,
                'type' => 0,
                'desc' => '{"en":"The spirits of the Rainforest are everywhere. You can communicate with them and get help from them. But be afraid to anger them!"}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => 2,
                'dome_id' => NULL,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-16 02:45:10',
                'updated_at' => '2022-11-16 02:45:10',
            ),
            4 => 
            array (
                'id' => 38,
                'card_id' => 80,
                'scope_id' => 55,
                'type' => 1,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => 2,
                'dome_id' => NULL,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-16 03:11:57',
                'updated_at' => '2022-11-16 12:54:18',
            ),
            5 => 
            array (
                'id' => 37,
                'card_id' => 80,
                'scope_id' => 82,
                'type' => 1,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => 2,
                'dome_id' => NULL,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-16 03:05:29',
                'updated_at' => '2022-11-16 12:54:34',
            ),
            6 => 
            array (
                'id' => 36,
                'card_id' => 80,
                'scope_id' => 81,
                'type' => 1,
                'desc' => '{"en":"The skill level of taming different creatures is different."}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => 2,
                'dome_id' => NULL,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-16 02:59:57',
                'updated_at' => '2022-11-16 12:54:48',
            ),
            7 => 
            array (
                'id' => 35,
                'card_id' => 80,
                'scope_id' => 11,
                'type' => 1,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => 2,
                'dome_id' => NULL,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-16 02:51:06',
                'updated_at' => '2022-11-16 12:55:07',
            ),
            8 => 
            array (
                'id' => 29,
                'card_id' => 80,
                'scope_id' => 8,
                'type' => 1,
                'desc' => '{"en":"Each character has specifications. Use this card as a character scope to list them."}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => 2,
                'dome_id' => NULL,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-15 17:53:59',
                'updated_at' => '2022-11-16 12:56:17',
            ),
            9 => 
            array (
                'id' => 28,
                'card_id' => 80,
                'scope_id' => 73,
                'type' => 1,
                'desc' => '{"en":"Damage to the hero"}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => 2,
                'dome_id' => NULL,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-15 17:44:56',
                'updated_at' => '2022-11-16 12:56:35',
            ),
            10 => 
            array (
                'id' => 26,
                'card_id' => 80,
                'scope_id' => 42,
                'type' => 1,
                'desc' => '{"en":"Our hero begins his adventure with a certain set of knowledge and continues to accumulate them."}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => 2,
                'dome_id' => NULL,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-15 17:36:23',
                'updated_at' => '2022-11-16 13:18:27',
            ),
            11 => 
            array (
                'id' => 27,
                'card_id' => 80,
                'scope_id' => 12,
                'type' => 2,
                'desc' => '{"en":"The place where our hero is located. Always one card."}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => 2,
                'dome_id' => NULL,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-15 17:39:14',
                'updated_at' => '2022-11-24 19:30:14',
            ),
            12 => 
            array (
                'id' => 39,
                'card_id' => 80,
                'scope_id' => 14,
                'type' => 2,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => 2,
                'dome_id' => NULL,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-24 19:33:47',
                'updated_at' => '2022-11-24 19:33:47',
            ),
            13 => 
            array (
                'id' => 40,
                'card_id' => 80,
                'scope_id' => 16,
                'type' => 2,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => 2,
                'dome_id' => NULL,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-24 19:35:32',
                'updated_at' => '2022-11-24 23:31:41',
            ),
            14 => 
            array (
                'id' => 49,
                'card_id' => 80,
                'scope_id' => 15,
                'type' => 2,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => 2,
                'dome_id' => NULL,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-25 00:17:05',
                'updated_at' => '2022-11-25 00:17:05',
            ),
            15 => 
            array (
                'id' => 51,
                'card_id' => 8,
                'scope_id' => 11,
                'type' => 3,
                'desc' => '{"en":"This deck contains all the possible Skills that a Character can have. Each card in this Skill deck can be a scope for a specific Character deck with specializations for that Skill The game algorithm will automatically check if the Character has decks for each of these Skills and assemble them into a single Skill deck.","ru":"?????? ???????????? ???????????????? ?????? ?????????????????? ????????????, ???????????????? ?????????? ???????????????? ??????????????????. ???????????? ?????????? ?? ???????? ???????????? ?????????????? ?????????? ???????? ???????????? ?????? ?????????????????????????????? ???????????? ?????????????????? ???? ?????????????????????????????? ?????? ?????????????? ????????????. ???????????????? ???????? ?????????????????????????? ????????????????, ???????? ???? ?? ?????????????? ?????????????????? ???????????? ?????? ?????????????? ???? ???????? ??????????????, ?? ?????????????? ???? ?? ???????????? ???????????? ??????????????."}',
                'is_public' => true,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => 1,
                'dome_id' => NULL,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-25 02:12:31',
                'updated_at' => '2022-11-25 04:42:49',
            ),
            16 => 
            array (
                'id' => 55,
                'card_id' => 33,
                'scope_id' => 12,
                'type' => 1,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => NULL,
                'dome_id' => NULL,
                'land_id' => NULL,
                'area_id' => 1,
                'scene_id' => NULL,
                'created_at' => '2022-12-04 18:41:56',
                'updated_at' => '2022-12-06 15:24:49',
            ),
            17 => 
            array (
                'id' => 54,
                'card_id' => 83,
                'scope_id' => 15,
                'type' => 2,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => NULL,
                'dome_id' => NULL,
                'land_id' => NULL,
                'area_id' => 1,
                'scene_id' => NULL,
                'created_at' => '2022-12-04 18:36:31',
                'updated_at' => '2022-12-06 15:25:51',
            ),
            18 => 
            array (
                'id' => 46,
                'card_id' => 61,
                'scope_id' => 14,
                'type' => 1,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => NULL,
                'dome_id' => 1,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-24 19:52:58',
                'updated_at' => '2022-12-06 15:28:20',
            ),
            19 => 
            array (
                'id' => 44,
                'card_id' => 51,
                'scope_id' => 14,
                'type' => 1,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => NULL,
                'dome_id' => 1,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-24 19:50:27',
                'updated_at' => '2022-12-06 15:37:46',
            ),
            20 => 
            array (
                'id' => 43,
                'card_id' => 54,
                'scope_id' => 14,
                'type' => 1,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => NULL,
                'dome_id' => 1,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-24 19:49:11',
                'updated_at' => '2022-12-06 15:43:40',
            ),
            21 => 
            array (
                'id' => 42,
                'card_id' => 49,
                'scope_id' => 14,
                'type' => 1,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => NULL,
                'dome_id' => 1,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-24 19:47:51',
                'updated_at' => '2022-12-06 15:44:46',
            ),
            22 => 
            array (
                'id' => 33,
                'card_id' => 77,
                'scope_id' => 22,
                'type' => 1,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => NULL,
                'dome_id' => 1,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-16 02:34:21',
                'updated_at' => '2022-12-06 15:48:08',
            ),
            23 => 
            array (
                'id' => 24,
                'card_id' => 69,
                'scope_id' => 22,
                'type' => 1,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => NULL,
                'dome_id' => 1,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-13 19:41:38',
                'updated_at' => '2022-12-06 15:57:00',
            ),
            24 => 
            array (
                'id' => 18,
                'card_id' => 61,
                'scope_id' => 64,
                'type' => 1,
                'desc' => '{"en":"Green anacondas feed on large rodents, deer, fish, peccaries, capybaras, tapirs, turtles, birds, dogs, sheep, aquatic reptiles like caiman, and even jaguars. After asphyxiating their prey, they are able to unhinge their jaws to swallow their prey head-first and whole, regardless of size. Their large meals can take time to digest, allowing them to go weeks or even months without feeding. Young anacondas feed on small rodents, chicks, frogs, and fish."}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => NULL,
                'dome_id' => 1,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-13 02:38:47',
                'updated_at' => '2022-12-06 16:08:23',
            ),
            25 => 
            array (
                'id' => 19,
                'card_id' => 53,
                'scope_id' => 14,
                'type' => 1,
                'desc' => '{"en":"Capybaras have partially webbed feet, which help to propel them through the water or swampy areas. Similar to a hippopotamus, the capybara???s eyes, nose, and ears are located on the top of its head, allowing it to peek above the surface for a breath of air and a quick check for predators while the bulk of its body remains hidden beneath the water.\\r\\n\\r\\nThey are semi-aquatic and will spend most of their time in dense vegetation around rivers, lakes, ponds, marshes, and swamps."}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => NULL,
                'dome_id' => 1,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-13 02:42:02',
                'updated_at' => '2022-12-06 16:17:48',
            ),
            26 => 
            array (
                'id' => 4,
                'card_id' => 52,
                'scope_id' => 22,
                'type' => 1,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => NULL,
                'dome_id' => 1,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-12 16:51:25',
                'updated_at' => '2022-12-06 16:17:56',
            ),
            27 => 
            array (
                'id' => 5,
                'card_id' => 53,
                'scope_id' => 22,
                'type' => 1,
                'desc' => '{"en":"Capybaras are naturally threatened by jaguars, caimans and anacondas, and their young can be taken by ocelots and harpy eagles."}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => NULL,
                'dome_id' => 1,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-12 16:51:37',
                'updated_at' => '2022-12-06 16:19:27',
            ),
            28 => 
            array (
                'id' => 21,
                'card_id' => 51,
                'scope_id' => 22,
                'type' => 1,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => NULL,
                'dome_id' => 1,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-13 03:03:22',
                'updated_at' => '2022-12-06 16:20:07',
            ),
            29 => 
            array (
                'id' => 10,
                'card_id' => 51,
                'scope_id' => 64,
                'type' => 1,
                'desc' => '{"en":"Jaguars are known to eat more than 85 species of prey, including armadillos, peccaries, capybaras, tapir, deer, squirrels, birds, and even snails. Not confined to hunting on land, jaguars are adept at snatching fish, turtles, and young caiman from the water. They are even able to hunt monkeys and other tree-dwellers who occasionally wander to lower branches."}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => NULL,
                'dome_id' => 1,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-12 16:53:38',
                'updated_at' => '2022-12-06 16:22:53',
            ),
            30 => 
            array (
                'id' => 53,
                'card_id' => 7,
                'scope_id' => 10,
                'type' => 3,
                'desc' => '{"en":"This deck contains all the cycles of Time that can affect the presence of a Creature. Each of these cards can be a scope for a Creature deck that lists the Time of a given cycle during which a Creature can be discovered. The game algorithm will automatically check for the presence of decks of these types for each Creature and collect them into a single deck of Time.","ru":"?????? ???????????? ???????????????? ?????? ?????????? ??????????????, ?????????????? ?????????? ???????????????? ???? ?????????????????????? ???????? ?????? ?????????? ????????????????. ???????????? ???? ???????? ???????? ?????????? ???????? ???????????? ?????? ???????????? ???????????????????? ????????????????, ?? ?????????????? ?????????????? ?????????????? ?????????????? ??????????, ?????????? ?????????? ???????? ???????????????????? ???????????? ????????????????. ???????????????? ???????? ?????????????????????????? ???????????????? ?????????????? ?????????? ???????????? ???????? ?????? ?????????????? ???????????????? ?? ?????????????? ???? ?? ???????? ???????????? ??????????????."}',
                'is_public' => true,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => 1,
                'dome_id' => NULL,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-25 03:15:12',
                'updated_at' => '2022-11-25 04:34:00',
            ),
            31 => 
            array (
                'id' => 31,
                'card_id' => 35,
                'scope_id' => 19,
                'type' => 0,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => NULL,
                'dome_id' => NULL,
                'land_id' => 1,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-15 21:42:11',
                'updated_at' => '2022-12-06 15:54:19',
            ),
            32 => 
            array (
                'id' => 32,
                'card_id' => 35,
                'scope_id' => 20,
                'type' => 0,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => NULL,
                'dome_id' => NULL,
                'land_id' => 1,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-16 02:03:36',
                'updated_at' => '2022-12-06 15:49:04',
            ),
            33 => 
            array (
                'id' => 52,
                'card_id' => 9,
                'scope_id' => 10,
                'type' => 3,
                'desc' => '{"en":"This deck contains cards that describe the different cycles of the current Time of the game. Each of these cards is a scope for a special state Hero deck containing the current phase of a given Time cycle. All cards with a Hero scope will inherit this control deck. The game algorithm will automatically check the Hero for the presence of decks of these types and assemble them into a single deck of Time.\\r\\n\\r\\nIf you need to keep track of Days, Moons, and Years, then create in your book the same deck for the Hero but with the set type.","ru":"?????? ???????????? ???????????????? ??????????, ?????????????????????? ?????????????????? ?????????? ???????????????? ?????????????? ???????? ???????????????????????? ???? ???????????????? ??????????. ???????????? ???? ???????? ???????? ???????????????? ???????????? ?????? ?????????????????????? ???????????? ??????????, ???????????????????? ?????????????? ???????? ?????????????? ?????????? ??????????????. ?????? ?????????? ?? ?????????? ?????????? ?????????????????? ?????? ?????????????????????? ????????????. ???????????????? ???????? ?????????? ?????????????????????????? ?????????????????? ?????????? ???? ?????????????? ?????????? ???????????? ???????? ?? ???????????????? ???? ?? ???????????? ???????????? ??????????????.\\r\\n\\r\\n???????? ?????? ?????????? ?????????? ???????? ????????, ?????????????? ?? ??????, ???? ???????????????? ?? ?????????? ?????????? ???? ???????????? ?????? ??????????, ???? ?? ?????????? Set."}',
                'is_public' => true,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => 1,
                'dome_id' => NULL,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-25 03:09:45',
                'updated_at' => '2022-11-25 04:38:08',
            ),
            34 => 
            array (
                'id' => 56,
                'card_id' => 96,
                'scope_id' => 14,
                'type' => 1,
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => NULL,
                'dome_id' => 1,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-12-06 17:23:52',
                'updated_at' => '2022-12-06 17:23:52',
            ),
            35 => 
            array (
                'id' => 50,
                'card_id' => 6,
                'scope_id' => 4,
                'type' => 3,
                'desc' => '{"en":"This control deck contains cards that describe the Space where a given Item can be found. Each of these cards is a scope for that Item deck, with a list of Places of that type:\\r\\n- Dome\\r\\n- Biome\\r\\n- Area\\r\\n- Geo\\r\\n- Folk\\r\\n- Scene\\r\\n\\r\\nAll Items inherit this control deck unless they have another Space control deck in their scope hierarchy. This means that the game algorithm will automatically check for cards of the Item scope for the presence of decks of these four types and collect them into a single deck of the Space type.\\r\\n\\r\\nAs a general rule, if some Item has a set deck of any of these Space types, then this means that this Item can only be found in these Spaces. If there is no deck of any type, then there are no restrictions on this type of Space.\\r\\n\\r\\nEXAMPLES:\\r\\n- If an Item has a set deck with a Folk scope and that deck only has one City card, that means that this Item is only found in any City.\\r\\n- If an Item has a Biome deck with a Hot Desert card and a Scene deck with a Temple card, then that Item requires both types of Space to be detected.","ru":"?????? ???????????? ???????????????????? ???????????????? ??????????, ?????????????????????? ??????????, ?? ?????????????? ?????????? ???????????????????? ???????????? ??????????????. ???????????? ???? ???????? ???????? ?????????? ???????? ???????????? ?????? ?????????????????????????????? ???????????? ???????????? ????????????????, ???????????????????? ?????????? ?????????????? ????????.\\r\\n\\r\\n?????? ???????????????? ?????????????????? ?????? ?????????????????????? ????????????, ???????? ?? ???? ???????????????? ?????????? ?????? ???????????? ?????????????????????? ???????????? ????????. ?????? ????????????????, ?????? ???????????????? ???????? ?????????? ?????????????????????????? ?????????????????? ?????????? ???????? ???????????????? ???? ?????????????? ?????????? ???????? ?????????????? ?????????? ?? ???????????????? ???? ?? ???????? ???????????? ??????????.\\r\\n\\r\\n?????? ??????????????, ???????? ?? ????????????-???? ???????????????? ???????? ???????????? ???????????? ???? ???????? ?????????? ????????, ???? ?????? ????????????????, ?????? ???????????? ?????????????? ?????????? ?????????? ???????????? ?? ???????? ????????????. ???????? ???? ???????????? ????????????-???????? ???????? ??????????????????????, ???? ?????? ?????????? ???????? ???????? ?????? ?????????????? ??????????????????????.\\r\\n\\r\\n??????????????:\\r\\n- ???????? ?? ???????????????? ???????? ???????????? ???? ???????????? ?????????? ?? ?? ???????? ???????????? ???????? ???????????? ???????? ?????????? ??????????, ?????? ????????????????, ?????? ???????? ?????????????? ?????????? ?????????? ???????????? ?? ?????????? ????????????.\\r\\n- ???????? ?? ???????????????? ???????? ???????????? ?????????? ?? ???????????? ?????????????? ?? ???????????? ?????????? ?? ???????????? ????????, ???? ?????? ?????????????????????? ?????????? ???????????????? ?????????? ???????????? ?????????????????? ?? ?????????? ?????????? ????????."}',
                'is_public' => true,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => 1,
                'dome_id' => NULL,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-25 00:43:12',
                'updated_at' => '2022-12-08 20:09:39',
            ),
            36 => 
            array (
                'id' => 47,
                'card_id' => 9,
                'scope_id' => 4,
                'type' => 3,
                'desc' => '{"en":"Cards in this control deck describe the Hero\'s current location. Each of these cards is scope for Hero\'s decks with type state, which indicate the specific current Places of these types:\\r\\n- Dome\\r\\n- Area\\r\\n- Scene\\r\\n- Folk\\r\\n\\r\\nThe current Spaces of these four types change during the game. They play an important role in determining the Events that can happen to the Hero.\\r\\n\\r\\nAll Heroes inherit this deck unless they have another Space deck in their scope hierarchy. This means that the game algorithm will automatically check for cards of the Hero scope for the presence of decks of these four types and collect them into a single deck of the Space type.","ru":"?????????? ?? ???????? ???????????? ???????????????????? ?????????????????? ?????????????? ???????????????????????????? ??????????. ???????????? ???? ???????? ???????? ???????????????? ???????????? ?????? ???????????? ?????????? ?? ?????????? ??????????????????, ?????????????? ?????????????????? ???? ?????????????? ?????????? ?????????????? ????????, ?? ?????????????? ???????????? ?????????????????? ??????????.\\r\\n\\r\\n?????????????? ?????????? ???????? ?????????????? ?????????? ???????????????? ???? ?????????? ????????. ?????? ???????????? ???????????? ???????? ?? ?????????????????????? ??????????????, ?????????????? ?????????? ?????????????????? ?? ????????????.\\r\\n\\r\\n?????? ?????????? ?????????????????? ?????? ????????????, ???????? ?? ???????????????? ???? ?????????? ?????? ???????????? ?????????????????????? ???????????? ????????. ?????? ????????????????, ?????? ???????????????? ???????? ?????????? ?????????????????????????? ?????????????????? ?????????? ???????? ?????????? ???? ?????????????? ?????????? ???????? ?????????????? ?????????? ?? ???????????????? ???? ?? ???????????? ???????????? ??????????."}',
                'is_public' => true,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => 1,
                'dome_id' => NULL,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-24 23:47:11',
                'updated_at' => '2022-12-08 19:59:34',
            ),
            37 => 
            array (
                'id' => 48,
                'card_id' => 7,
                'scope_id' => 4,
                'type' => 3,
                'desc' => '{"en":"This control deck contains cards that describe locations where a given Creature can be found. Each of these cards is a scope for that Creature\'s deck, with a list of Places of that type:\\r\\n- Dome\\r\\n- Biome\\r\\n- Geo\\r\\n- Area\\r\\n- Folk\\r\\n- Scene\\r\\n\\r\\nAll Creatures inherit this control deck unless they have another Space control deck in their scopes hierarchy. This means that the game algorithm will automatically check for cards of the Creature scope for the presence of decks of these four types and collect them into a single deck of the Space type.\\r\\n\\r\\nAs a general rule, if a Creature has a deck of any of these Space types, then this means that this Creature can only be found in these Spaces. If there is no deck of any type, then there are no restrictions on this type of Space.\\r\\n\\r\\nEXAMPLES:\\r\\n- If a Creature has a deck with a Folk scope and that deck only has one Wilderness card, that means that this Creature is only found where there aren\'t any significant crowds of Folk.\\r\\n- If a Creature has a Biome deck with a Rainforest card and a Geo deck with a Mountain card, then that creature requires both types of Space to be detected.","ru":"?????? ???????????? ???????????????????? ???????????????? ??????????, ?????????????????????? ??????????, ?????? ?????????? ???????????????????? ???????????? ????????????????. ???????????? ???? ???????? ???????? ?????????? ???????? ???????????? ?????? ???????????? ???????????? ???????????????? ???? ?????????????? ???????? ???????? ?????????????? ????????.\\r\\n\\r\\n?????? ???????????????? ?????????????????? ?????? ?????????????????????? ????????????, ???????? ?? ???? ???????????????? ?????????? ?????? ???????????? ?????????????????????? ???????????? ??????????. ?????? ????????????????, ?????? ???????????????? ???????? ?????????? ?????????????????????????? ?????????????????? ?????????? ???????? ???????????????? ???? ?????????????? ?????????? ???????? ?????????????? ?????????? ?? ???????????????? ???? ?? ???????????? ???????????? ??????????.\\r\\n\\r\\n?????? ??????????????, ???????? ?? ???????????????? ???????? ???????????? ???????????? ???? ???????? ?????????? ????????, ???? ?????? ????????????????, ?????? ?????? ???????????????? ?????????? ?????????? ???????????? ?? ???????? ????????????. ???????? ???????????? ????????????-???????? ???????? ??????, ???? ?????? ?????????? ???????? ???????? ?????? ?????????????? ??????????????????????.\\r\\n\\r\\n??????????????:\\r\\n- ???????? ?? ???????????????? ???????? ???????????? ???? ???????????? ??????????, ?? ?? ???????? ???????????? ???????? ???????????? ???????? ?????????? ?????????? ??????????, ?????? ????????????????, ?????? ?????? ???????????????? ?????????? ?????????? ???????????? ??????, ?????? ?????? ?????????????????????????? ??????????????????.\\r\\n- ???????? ?? ???????????????? ???????? ???????????? ???????????? ?? ???????????? ?????????????? ?? ???????????? ?????????????? ?? ???????????? ????????, ???? ?????? ?????????????????????? ?????????? ???????????????? ?????????? ???????????? ?????????????????? ?? ?????????? ?????????? ????????."}',
                'is_public' => true,
                'image' => NULL,
                'owner_id' => 1,
                'game_id' => NULL,
                'book_id' => 1,
                'dome_id' => NULL,
                'land_id' => NULL,
                'area_id' => NULL,
                'scene_id' => NULL,
                'created_at' => '2022-11-24 23:50:18',
                'updated_at' => '2022-12-08 20:04:22',
            ),
        ));
        
        
    }
}