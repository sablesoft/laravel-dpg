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
                'id' => 8,
                'scope_id' => 3,
                'image' => NULL,
                'name' => '{"en":"Airi","ru":"Айри"}',
                'desc' => '{"en":"Many tribes of the Rainforest believe in the existence of a powerful and wise spirit who is the guardian and protector of the jungle, as well as all its inhabitants.","ru":"Многие племена Тропического Леса верят в существование могущественного и мудрого духа, который является хранителем и защитником джунглей, а также всех его обитателей."}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-08 02:35:19',
                'updated_at' => '2022-11-09 04:41:22',
            ),
            1 => 
            array (
                'id' => 7,
                'scope_id' => 3,
                'image' => NULL,
                'name' => '{"en":"Shiinhaku","ru":"Шиинхаку"}',
                'desc' => '{"en":"From time immemorial, the various tribes of the Rainforest have legends about this insidious and evil spirit.","ru":"С незапамятных времен у различных племен Тропического Леса ходят легенды об этом коварном и злобном духе."}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-08 02:34:07',
                'updated_at' => '2022-11-09 04:41:35',
            ),
            2 => 
            array (
                'id' => 6,
                'scope_id' => 3,
                'image' => NULL,
                'name' => '{"en":"Pua","ru":"Пуа"}',
                'desc' => '{"en":"Perhaps this is the most educated boy in the entire settlement. From an early age, he showed great interest in the legends and knowledge of his tribe. This is one of the few guys who can read and write well and loves to do it.\\r\\n\\r\\nMany, not without reason, believe that the old keeper is preparing this boy to replace him.","ru":"Пожалуй, это самый образованный мальчик во всем поселении. С малых лет он проявил большой интерес к легендам и знаниям своего племени. Это один из немногих ребят, кто умеет хорошо читать и писать и любит этим заниматься.\\r\\n\\r\\nМногие не без оснований считают, что старый хранитель готовит этого мальчика себе на смену."}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-08 02:33:05',
                'updated_at' => '2022-11-09 04:41:47',
            ),
            3 => 
            array (
                'id' => 4,
                'scope_id' => 3,
                'image' => NULL,
                'name' => '{"en":"Araki","ru":"Араки"}',
                'desc' => '{"en":"This is a bright and noisy toucan, the favorite pet of Rekko, Titu\'s father.","ru":"Это яркий и шумный тукан, любимый питомец Рекко, отца Титу."}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-08 02:29:38',
                'updated_at' => '2022-11-09 04:42:13',
            ),
            4 => 
            array (
                'id' => 3,
                'scope_id' => 3,
                'image' => NULL,
                'name' => '{"en":"Titu","ru":"Титу"}',
                'desc' => '{"en":"The boy from the forest tribe. Originally from the small settlement of Lanza Piya. Raised by parents and other residents of the settlement. Has a younger sister. Smart. Leader among peers.","ru":"Мальчик из лесного племени. Родом из небольшого поселения Ланза Пийя. Воспитан родителями и другими жителями поселения. Имеет младшую сестру. Умен и сообразителен. Лидер среди сверстников."}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-08 02:27:58',
                'updated_at' => '2022-11-09 04:42:27',
            ),
            5 => 
            array (
                'id' => 2,
                'scope_id' => 1,
                'image' => NULL,
                'name' => '{"en":"Eagle Nest","ru":"Орлиное Гнездо"}',
                'desc' => '{"en":"This ancient clan still lives in the depths of the unknown to this day. Finding the way to the inconspicuous is easy. But everyone who follows his own path of the heart will certainly meet him.","ru":"Этот древний клан и по сей день живет в самых недрах неизведанного. Найти дорогу к нему не просто. Но каждый, кто следует своему пути сердца однажды непременно встречается с ним"}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-06 05:16:54',
                'updated_at' => '2022-11-09 04:42:58',
            ),
            6 => 
            array (
                'id' => 1,
                'scope_id' => 1,
                'image' => NULL,
                'name' => '{"en":"Serpent Path","ru":"Тропа Змея"}',
                'desc' => '{"en":"The wise people follow the sacred path of the Serpent. Everyone who walks this path cultivates living blood in himself. Everyone who walks this path holds on to the other in order to honor this path together.","ru":"Мудрый народ следует священной Тропе Змея. Каждый, идущий по этой тропе, взращивает в себе кровь живую. Каждый, идущий по этой тропе, держится другого чтобы вместе чтить этот путь."}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-06 05:09:50',
                'updated_at' => '2022-11-09 04:43:14',
            ),
            7 => 
            array (
                'id' => 9,
                'scope_id' => 3,
                'image' => NULL,
                'name' => '{"en":"Lilika","ru":"Лилика"}',
                'desc' => '{"en":"Although this young lady was nicknamed Beauty in the settlement, it should be noted that this is by no means her only virtue. Everyone is well aware of her talents for healing, especially after she began to help many of her tribe.\\r\\n\\r\\nIn addition, Lilika has always been distinguished by unprecedented seriousness and diligence in the study of plants and various healing agents. By her childhood years, she had already managed to accumulate considerable knowledge and skills in these areas.","ru":"Хотя эту молодую особу и прозвали в поселении Красавицей, нужно отметить что это вовсе не единственное ее достоинство. Всем хорошо известны ее таланты к целительству, особенно после того как она начала помогать многим из своего племени. \\r\\n\\r\\nКроме того, Лилика всегда отличалась небывалой серьезностью и старательностью в изучении растений и различных целебных средств. К своим детским годам она уже успела накопить немалые знания и навыки в этих сферах."}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-08 02:36:25',
                'updated_at' => '2022-11-09 04:41:07',
            ),
            8 => 
            array (
                'id' => 5,
                'scope_id' => 3,
                'image' => NULL,
                'name' => '{"en":"Zaizi","ru":"Зайзи"}',
                'desc' => '{"en":"This boy, like all other children in his village, was brought up not only by his parents but by the whole tribe. He has a sharp mind and sparkling humor. Loves to joke and make fun. Regularly plunges into various stories. He has a great talent for singing and artistic performances. Careless and careless.\\r\\n\\r\\nLike all his peers, Zaizi will soon have to go through his initiation ceremony. However, the boy does not think about it at all, because he is worried about completely different questions, let\'s say ... of a cordial nature ...\\r\\n\\r\\nFrom an early age, he leads a strong friendship with his peer Titu, with whom they spend a lot of time organizing all sorts of tricks.","ru":"Этот мальчик, как и все прочие дети в его поселке, воспитывался не только своими родителями, но и всем племенем. Обладает острым умом и искрометным юмором. Обожает шутить и подшучивать. Регулярно вляпывается в различные истории. Имеет большой талант к пению и артистическим выступлениям. Беспечен и легкомысленен.\\r\\n\\r\\nКак и всем его сверстникам, вскоре Зайзи предстоит пройти свою церемонию инициации. Впрочем, мальчик совсем не думает об этом, поскольку его беспокоят совершенно другие вопросы, скажем так... сердечного характера...\\r\\n\\r\\nС малых лет ведет крепкую дружбу со своим сверстником Титу, с которым они проводят много времени, организуя всяческие проделки."}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-08 02:31:41',
                'updated_at' => '2022-11-09 04:42:00',
            ),
            9 => 
            array (
                'id' => 16,
                'scope_id' => 15,
                'image' => NULL,
                'name' => '{"en":"Bird Encounter","ru":"Встреча - Птица"}',
                'desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-09 05:10:58',
                'updated_at' => '2022-11-10 01:55:58',
            ),
            10 => 
            array (
                'id' => 15,
                'scope_id' => 15,
                'image' => NULL,
                'name' => '{"en":"Insect Encounter","ru":"Встреча - Насекомое"}',
                'desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-09 05:09:34',
                'updated_at' => '2022-11-10 01:56:24',
            ),
            11 => 
            array (
                'id' => 14,
                'scope_id' => 15,
                'image' => NULL,
                'name' => '{"en":"Character Encounter","ru":"Встреча - Персонаж"}',
                'desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-09 05:07:18',
                'updated_at' => '2022-11-10 01:56:45',
            ),
            12 => 
            array (
                'id' => 13,
                'scope_id' => 15,
                'image' => NULL,
                'name' => '{"en":"Spirit Encounter","ru":"Встреча - Дух"}',
                'desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-09 05:01:41',
                'updated_at' => '2022-11-10 01:57:09',
            ),
            13 => 
            array (
                'id' => 12,
                'scope_id' => 15,
                'image' => NULL,
                'name' => '{"en":"Human Encounter","ru":"Встреча - Человек"}',
                'desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-09 05:00:36',
                'updated_at' => '2022-11-10 01:57:28',
            ),
            14 => 
            array (
                'id' => 11,
                'scope_id' => 15,
                'image' => NULL,
                'name' => '{"en":"Plant Encounter","ru":"Встреча - Растение"}',
                'desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-09 04:58:48',
                'updated_at' => '2022-11-10 01:57:46',
            ),
            15 => 
            array (
                'id' => 10,
                'scope_id' => 15,
                'image' => NULL,
                'name' => '{"en":"Animal Encounter","ru":"Встреча - Животное"}',
                'desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-09 04:57:14',
                'updated_at' => '2022-11-10 01:58:07',
            ),
            16 => 
            array (
                'id' => 17,
                'scope_id' => 15,
                'image' => NULL,
                'name' => '{"en":"Way Event"}',
                'desc' => '{"en":"Something happened along the way. Draw a card from the deck."}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-10 13:55:09',
                'updated_at' => '2022-11-10 13:55:09',
            ),
            17 => 
            array (
                'id' => 18,
                'scope_id' => 18,
                'image' => NULL,
                'name' => '{"en":"Lanza Piya"}',
                'desc' => '{"en":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-10 14:31:06',
                'updated_at' => '2022-11-10 14:31:06',
            ),
            18 => 
            array (
                'id' => 19,
                'scope_id' => 15,
                'image' => NULL,
                'name' => '{"en":"Rest Time"}',
                'desc' => '{"en":"Nothing special happened. But after a while, the hero decided to take a break. At the same time, he can switch to some practice."}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-10 14:37:54',
                'updated_at' => '2022-11-10 14:37:54',
            ),
            19 => 
            array (
                'id' => 20,
                'scope_id' => 10,
                'image' => NULL,
                'name' => '{"en":"Legends"}',
                'desc' => '{"en":"A people without legends is like a tree without roots."}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-10 15:34:14',
                'updated_at' => '2022-11-10 15:34:14',
            ),
            20 => 
            array (
                'id' => 21,
                'scope_id' => 1,
                'image' => NULL,
                'name' => '{"en":"Knowledge"}',
                'desc' => '{"en":"Nothing is free in this world, and the acquisition of knowledge is the most difficult of all tasks that a person can face."}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-10 15:40:03',
                'updated_at' => '2022-11-10 15:40:03',
            ),
        ));
        
        
    }
}