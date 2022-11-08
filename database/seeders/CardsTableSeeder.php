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
            2 => 
            array (
                'id' => 9,
                'scope_id' => 3,
                'name' => '{"en":"Lilika","ru":"Лилика"}',
                'desc' => '{"en":"Although this young lady was nicknamed Beauty in the settlement, it should be noted that this is by no means her only virtue. Everyone is well aware of her talents for healing, especially after she began to help many of her tribe.\\r\\n\\r\\nIn addition, Lilika has always been distinguished by unprecedented seriousness and diligence in the study of plants and various healing agents. By her childhood years, she had already managed to accumulate considerable knowledge and skills in these areas.","ru":"Хотя эту молодую особу и прозвали в поселении Красавицей, нужно отметить что это вовсе не единственное ее достоинство. Всем хорошо известны ее таланты к целительству, особенно после того как она начала помогать многим из своего племени. \\r\\n\\r\\nКроме того, Лилика всегда отличалась небывалой серьезностью и старательностью в изучении растений и различных целебных средств. К своим детским годам она уже успела накопить немалые знания и навыки в этих сферах."}',
                'private_desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-08 02:36:25',
                'updated_at' => '2022-11-08 02:46:55',
            ),
            3 => 
            array (
                'id' => 8,
                'scope_id' => 3,
                'name' => '{"en":"Airi","ru":"Айри"}',
                'desc' => '{"en":"Many tribes of the Rainforest believe in the existence of a powerful and wise spirit who is the guardian and protector of the jungle, as well as all its inhabitants.","ru":"Многие племена Тропического Леса верят в существование могущественного и мудрого духа, который является хранителем и защитником джунглей, а также всех его обитателей."}',
                'private_desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-08 02:35:19',
                'updated_at' => '2022-11-08 02:48:09',
            ),
            4 => 
            array (
                'id' => 7,
                'scope_id' => 3,
                'name' => '{"en":"Shiinhaku","ru":"Шиинхаку"}',
                'desc' => '{"en":"From time immemorial, the various tribes of the Rainforest have legends about this insidious and evil spirit.","ru":"С незапамятных времен у различных племен Тропического Леса ходят легенды об этом коварном и злобном духе."}',
                'private_desc' => '{"en":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-08 02:34:07',
                'updated_at' => '2022-11-08 02:50:27',
            ),
            5 => 
            array (
                'id' => 5,
                'scope_id' => 3,
                'name' => '{"en":"Zaizi","ru":"Зайзи"}',
                'desc' => '{"en":"This boy, like all other children in his village, was brought up not only by his parents but by the whole tribe. He has a sharp mind and sparkling humor. Loves to joke and make fun. Regularly plunges into various stories. He has a great talent for singing and artistic performances. Careless and careless.\\r\\n\\r\\nLike all his peers, Zaizi will soon have to go through his initiation ceremony. However, the boy does not think about it at all, because he is worried about completely different questions, let\'s say ... of a cordial nature ...\\r\\n\\r\\nFrom an early age, he leads a strong friendship with his peer Titu, with whom they spend a lot of time organizing all sorts of tricks.","ru":"Этот мальчик, как и все прочие дети в его поселке, воспитывался не только своими родителями, но и всем племенем. Обладает острым умом и искрометным юмором. Обожает шутить и подшучивать. Регулярно вляпывается в различные истории. Имеет большой талант к пению и артистическим выступлениям. Беспечен и легкомысленен.\\r\\n\\r\\nКак и всем его сверстникам, вскоре Зайзи предстоит пройти свою церемонию инициации. Впрочем, мальчик совсем не думает об этом, поскольку его беспокоят совершенно другие вопросы, скажем так... сердечного характера...\\r\\n\\r\\nС малых лет ведет крепкую дружбу со своим сверстником Титу, с которым они проводят много времени, организуя всяческие проделки."}',
                'private_desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-08 02:31:41',
                'updated_at' => '2022-11-08 02:52:11',
            ),
            6 => 
            array (
                'id' => 4,
                'scope_id' => 3,
                'name' => '{"en":"Araki","ru":"Араки"}',
                'desc' => '{"en":"This is a bright and noisy toucan, the favorite pet of Rekko, Titu\'s father.","ru":"Это яркий и шумный тукан, любимый питомец Рекко, отца Титу."}',
                'private_desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-08 02:29:38',
                'updated_at' => '2022-11-08 02:53:25',
            ),
            7 => 
            array (
                'id' => 3,
                'scope_id' => 3,
                'name' => '{"en":"Titu","ru":"Титу"}',
                'desc' => '{"en":"The boy from the forest tribe. Originally from the small settlement of Lanza Piya. Raised by parents and other residents of the settlement. Has a younger sister. Smart. Leader among peers.","ru":"Мальчик из лесного племени. Родом из небольшого поселения Ланза Пийя. Воспитан родителями и другими жителями поселения. Имеет младшую сестру. Умен и сообразителен. Лидер среди сверстников."}',
                'private_desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-08 02:27:58',
                'updated_at' => '2022-11-08 02:53:56',
            ),
            8 => 
            array (
                'id' => 6,
                'scope_id' => 3,
                'name' => '{"en":"Pua","ru":"Пуа"}',
                'desc' => '{"en":"Perhaps this is the most educated boy in the entire settlement. From an early age, he showed great interest in the legends and knowledge of his tribe. This is one of the few guys who can read and write well and loves to do it.\\r\\n\\r\\nMany, not without reason, believe that the old keeper is preparing this boy to replace him.","ru":"Пожалуй, это самый образованный мальчик во всем поселении. С малых лет он проявил большой интерес к легендам и знаниям своего племени. Это один из немногих ребят, кто умеет хорошо читать и писать и любит этим заниматься.\\r\\n\\r\\nМногие не без оснований считают, что старый хранитель готовит этого мальчика себе на смену."}',
                'private_desc' => '{"ru":null}',
                'owner_id' => 1,
                'is_public' => false,
                'created_at' => '2022-11-08 02:33:05',
                'updated_at' => '2022-11-08 02:51:20',
            ),
        ));
        
        
    }
}