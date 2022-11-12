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
                'name' => '{"en":"Airi","ru":"Айри"}',
                'desc' => '{"en":"Many tribes of the Rainforest believe in the existence of a powerful and wise spirit who is the guardian and protector of the jungle, as well as all its inhabitants.","ru":"Многие племена Тропического Леса верят в существование могущественного и мудрого духа, который является хранителем и защитником джунглей, а также всех его обитателей."}',
                'is_public' => false,
                'image' => NULL,
                'scope_id' => 3,
                'owner_id' => 1,
                'created_at' => '2022-11-08 02:35:19',
                'updated_at' => '2022-11-09 04:41:22',
            ),
            1 => 
            array (
                'id' => 7,
                'name' => '{"en":"Shiinhaku","ru":"Шиинхаку"}',
                'desc' => '{"en":"From time immemorial, the various tribes of the Rainforest have legends about this insidious and evil spirit.","ru":"С незапамятных времен у различных племен Тропического Леса ходят легенды об этом коварном и злобном духе."}',
                'is_public' => false,
                'image' => NULL,
                'scope_id' => 3,
                'owner_id' => 1,
                'created_at' => '2022-11-08 02:34:07',
                'updated_at' => '2022-11-09 04:41:35',
            ),
            2 => 
            array (
                'id' => 6,
                'name' => '{"en":"Pua","ru":"Пуа"}',
                'desc' => '{"en":"Perhaps this is the most educated boy in the entire settlement. From an early age, he showed great interest in the legends and knowledge of his tribe. This is one of the few guys who can read and write well and loves to do it.\\r\\n\\r\\nMany, not without reason, believe that the old keeper is preparing this boy to replace him.","ru":"Пожалуй, это самый образованный мальчик во всем поселении. С малых лет он проявил большой интерес к легендам и знаниям своего племени. Это один из немногих ребят, кто умеет хорошо читать и писать и любит этим заниматься.\\r\\n\\r\\nМногие не без оснований считают, что старый хранитель готовит этого мальчика себе на смену."}',
                'is_public' => false,
                'image' => NULL,
                'scope_id' => 3,
                'owner_id' => 1,
                'created_at' => '2022-11-08 02:33:05',
                'updated_at' => '2022-11-09 04:41:47',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => '{"en":"Araki","ru":"Араки"}',
                'desc' => '{"en":"This is a bright and noisy toucan, the favorite pet of Rekko, Titu\'s father.","ru":"Это яркий и шумный тукан, любимый питомец Рекко, отца Титу."}',
                'is_public' => false,
                'image' => NULL,
                'scope_id' => 3,
                'owner_id' => 1,
                'created_at' => '2022-11-08 02:29:38',
                'updated_at' => '2022-11-09 04:42:13',
            ),
            4 => 
            array (
                'id' => 2,
                'name' => '{"en":"Eagle Nest","ru":"Орлиное Гнездо"}',
                'desc' => '{"en":"This ancient clan still lives in the depths of the unknown to this day. Finding the way to the inconspicuous is easy. But everyone who follows his own path of the heart will certainly meet him.","ru":"Этот древний клан и по сей день живет в самых недрах неизведанного. Найти дорогу к нему не просто. Но каждый, кто следует своему пути сердца однажды непременно встречается с ним"}',
                'is_public' => false,
                'image' => NULL,
                'scope_id' => 1,
                'owner_id' => 1,
                'created_at' => '2022-11-06 05:16:54',
                'updated_at' => '2022-11-09 04:42:58',
            ),
            5 => 
            array (
                'id' => 1,
                'name' => '{"en":"Serpent Path","ru":"Тропа Змея"}',
                'desc' => '{"en":"The wise people follow the sacred path of the Serpent. Everyone who walks this path cultivates living blood in himself. Everyone who walks this path holds on to the other in order to honor this path together.","ru":"Мудрый народ следует священной Тропе Змея. Каждый, идущий по этой тропе, взращивает в себе кровь живую. Каждый, идущий по этой тропе, держится другого чтобы вместе чтить этот путь."}',
                'is_public' => false,
                'image' => NULL,
                'scope_id' => 1,
                'owner_id' => 1,
                'created_at' => '2022-11-06 05:09:50',
                'updated_at' => '2022-11-09 04:43:14',
            ),
            6 => 
            array (
                'id' => 9,
                'name' => '{"en":"Lilika","ru":"Лилика"}',
                'desc' => '{"en":"Although this young lady was nicknamed Beauty in the settlement, it should be noted that this is by no means her only virtue. Everyone is well aware of her talents for healing, especially after she began to help many of her tribe.\\r\\n\\r\\nIn addition, Lilika has always been distinguished by unprecedented seriousness and diligence in the study of plants and various healing agents. By her childhood years, she had already managed to accumulate considerable knowledge and skills in these areas.","ru":"Хотя эту молодую особу и прозвали в поселении Красавицей, нужно отметить что это вовсе не единственное ее достоинство. Всем хорошо известны ее таланты к целительству, особенно после того как она начала помогать многим из своего племени. \\r\\n\\r\\nКроме того, Лилика всегда отличалась небывалой серьезностью и старательностью в изучении растений и различных целебных средств. К своим детским годам она уже успела накопить немалые знания и навыки в этих сферах."}',
                'is_public' => false,
                'image' => NULL,
                'scope_id' => 3,
                'owner_id' => 1,
                'created_at' => '2022-11-08 02:36:25',
                'updated_at' => '2022-11-09 04:41:07',
            ),
            7 => 
            array (
                'id' => 5,
                'name' => '{"en":"Zaizi","ru":"Зайзи"}',
                'desc' => '{"en":"This boy, like all other children in his village, was brought up not only by his parents but by the whole tribe. He has a sharp mind and sparkling humor. Loves to joke and make fun. Regularly plunges into various stories. He has a great talent for singing and artistic performances. Careless and careless.\\r\\n\\r\\nLike all his peers, Zaizi will soon have to go through his initiation ceremony. However, the boy does not think about it at all, because he is worried about completely different questions, let\'s say ... of a cordial nature ...\\r\\n\\r\\nFrom an early age, he leads a strong friendship with his peer Titu, with whom they spend a lot of time organizing all sorts of tricks.","ru":"Этот мальчик, как и все прочие дети в его поселке, воспитывался не только своими родителями, но и всем племенем. Обладает острым умом и искрометным юмором. Обожает шутить и подшучивать. Регулярно вляпывается в различные истории. Имеет большой талант к пению и артистическим выступлениям. Беспечен и легкомысленен.\\r\\n\\r\\nКак и всем его сверстникам, вскоре Зайзи предстоит пройти свою церемонию инициации. Впрочем, мальчик совсем не думает об этом, поскольку его беспокоят совершенно другие вопросы, скажем так... сердечного характера...\\r\\n\\r\\nС малых лет ведет крепкую дружбу со своим сверстником Титу, с которым они проводят много времени, организуя всяческие проделки."}',
                'is_public' => false,
                'image' => NULL,
                'scope_id' => 3,
                'owner_id' => 1,
                'created_at' => '2022-11-08 02:31:41',
                'updated_at' => '2022-11-09 04:42:00',
            ),
            8 => 
            array (
                'id' => 14,
                'name' => '{"en":"Character","ru":"Встреча - Персонаж"}',
                'desc' => '{"en":"Any creature that plays an important role in this book is a character. Each character has a name, skills, knowledge, features and other characteristics."}',
                'is_public' => false,
                'image' => NULL,
                'scope_id' => 3,
                'owner_id' => 1,
                'created_at' => '2022-11-09 05:07:18',
                'updated_at' => '2022-11-12 04:37:46',
            ),
            9 => 
            array (
                'id' => 12,
                'name' => '{"en":"Human","ru":"Встреча - Человек"}',
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'scope_id' => 14,
                'owner_id' => 1,
                'created_at' => '2022-11-09 05:00:36',
                'updated_at' => '2022-11-12 04:41:42',
            ),
            10 => 
            array (
                'id' => 13,
                'name' => '{"en":"Spirit","ru":"Встреча - Дух"}',
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'scope_id' => 8,
                'owner_id' => 1,
                'created_at' => '2022-11-09 05:01:41',
                'updated_at' => '2022-11-12 04:47:35',
            ),
            11 => 
            array (
                'id' => 18,
                'name' => '{"en":"Lanza Piya"}',
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'scope_id' => 18,
                'owner_id' => 1,
                'created_at' => '2022-11-10 14:31:06',
                'updated_at' => '2022-11-10 14:31:06',
            ),
            12 => 
            array (
                'id' => 20,
                'name' => '{"en":"Legends"}',
                'desc' => '{"en":"A people without legends is like a tree without roots."}',
                'is_public' => false,
                'image' => NULL,
                'scope_id' => 10,
                'owner_id' => 1,
                'created_at' => '2022-11-10 15:34:14',
                'updated_at' => '2022-11-10 15:34:14',
            ),
            13 => 
            array (
                'id' => 21,
                'name' => '{"en":"Knowledge"}',
                'desc' => '{"en":"Nothing is free in this world, and the acquisition of knowledge is the most difficult of all tasks that a person can face."}',
                'is_public' => false,
                'image' => NULL,
                'scope_id' => 1,
                'owner_id' => 1,
                'created_at' => '2022-11-10 15:40:03',
                'updated_at' => '2022-11-10 15:40:03',
            ),
            14 => 
            array (
                'id' => 3,
                'name' => '{"en":"Titu","ru":"Титу"}',
                'desc' => '{"en":"The boy from the forest tribe. Originally from the small settlement of Lanza Piya. Raised by parents and other residents of the settlement. Has a younger sister. Smart. Leader among peers.","ru":"Мальчик из лесного племени. Родом из небольшого поселения Ланза Пийя. Воспитан родителями и другими жителями поселения. Имеет младшую сестру. Умен и сообразителен. Лидер среди сверстников."}',
                'is_public' => false,
                'image' => NULL,
                'scope_id' => 22,
                'owner_id' => 1,
                'created_at' => '2022-11-08 02:27:58',
                'updated_at' => '2022-11-10 23:34:10',
            ),
            15 => 
            array (
                'id' => 22,
                'name' => '{"en":"Totem Quest"}',
                'desc' => '{"en":"To pass the initiation ceremony, Titus needs to find his totem of power. The difficulty is that the boy so far has a rather poor understanding of what it is and where to look for it.\\r\\n\\r\\nTherefore, at every opportunity, he needs to extract any information on this topic."}',
                'is_public' => false,
                'image' => 'ym4kFiMwWuKnM1KfNx7ZsM1GgigRPVAaqZkeAx63.jpg',
                'scope_id' => 23,
                'owner_id' => 1,
                'created_at' => '2022-11-10 23:41:18',
                'updated_at' => '2022-11-10 23:41:18',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => '{"en":"Way"}',
                'desc' => '{"en":"Something always happens along the way..."}',
                'is_public' => false,
                'image' => NULL,
                'scope_id' => 15,
                'owner_id' => 1,
                'created_at' => '2022-11-10 13:55:09',
                'updated_at' => '2022-11-11 03:37:53',
            ),
            17 => 
            array (
                'id' => 28,
                'name' => '{"en":"Jaguar"}',
                'desc' => '{"en":"Jaguars spend much of their time on the ground. They use their padded paws to move silently through the forest floor. Although not quite as agile as a leopard, jaguars are capable of climbing trees to hunt or to rest.\\r\\n\\r\\nJaguars are mostly nocturnal hunters. They use their excellent vision and sharp teeth to ambush prey and crush their skulls. Jaguars are known to eat more than 85 species of prey, including armadillos, peccaries, capybaras, tapir, deer, squirrels, birds, and even snails. Not confined to hunting on land, jaguars are adept at snatching fish, turtles, and young caiman from the water. They are even able to hunt monkeys and other tree-dwellers who occasionally wander to lower branches."}',
                'is_public' => false,
                'image' => 'p4T9QxXKlY5BR2p0Y75BV7RLy5qCiBGcIUFD8VpC.jpg',
                'scope_id' => 12,
                'owner_id' => 1,
                'created_at' => '2022-11-12 02:59:15',
                'updated_at' => '2022-11-12 02:59:15',
            ),
            18 => 
            array (
                'id' => 10,
                'name' => '{"en":"Animal","ru":"Встреча - Животное"}',
                'desc' => '{"en":"This world is replete with an unimaginable variety of animals."}',
                'is_public' => false,
                'image' => NULL,
                'scope_id' => 12,
                'owner_id' => 1,
                'created_at' => '2022-11-09 04:57:14',
                'updated_at' => '2022-11-12 02:38:18',
            ),
            19 => 
            array (
                'id' => 11,
                'name' => '{"en":"Plant","ru":"Встреча - Растение"}',
                'desc' => '{"en":null}',
                'is_public' => false,
                'image' => NULL,
                'scope_id' => 13,
                'owner_id' => 1,
                'created_at' => '2022-11-09 04:58:48',
                'updated_at' => '2022-11-12 04:50:47',
            ),
            20 => 
            array (
                'id' => 26,
                'name' => '{"en":"Blue Morpho Butterfly"}',
                'desc' => '{"en":"With its brilliant, iridescent blue wings, the blue morpho butterfly flutters through the rainforest canopy. The many “eyespots” on its brown underside trick predators into thinking the butterfly is a large predator.\\r\\n\\r\\nThe blue morpho’s diet changes throughout each stage of its lifecycle. As a caterpillar, it chews leaves of many varieties but prefers to dine on plants in the pea family. When it becomes a butterfly it can no longer chew, but drinks its food instead. Adults use a long, protruding mouthpart called a proboscis as a drinking straw to sip the juice of rotting fruit, the fluids of decomposing animals, tree sap, fungi, and wet mud. Blue morphos taste fruit with sensors on their legs, and they “taste-smell” the air with their antennae, which serve as a combined tongue and nose.\\r\\n\\r\\nBirds like the jacamar and flycatcher are the adult butterfly’s natural predators."}',
                'is_public' => false,
                'image' => '4a5tCKCnyZjFIwKK8UUexarCh3Vs9cYVYnJZDm8y.jpg',
                'scope_id' => 7,
                'owner_id' => 1,
                'created_at' => '2022-11-12 02:19:01',
                'updated_at' => '2022-11-12 02:25:04',
            ),
            21 => 
            array (
                'id' => 15,
                'name' => '{"en":"Insect","ru":"Встреча - Насекомое"}',
                'desc' => '{"en":"Insects are the most diverse group of animals; they include more than a million described species and represent more than half of all known living organisms. The total number of extant species is estimated at between six and ten million; potentially over 90% of the animal life forms on Earth are insects.\\r\\n\\r\\nInsect pollinators are essential to the life cycle of many flowering plant species on which most organisms, including humans, are at least partly dependent; without them, the terrestrial portion of the biosphere would be devastated. Many insects are considered ecologically beneficial as predators and a few provide direct economic benefit. Silkworms produce silk and honey bees produce honey and both have been domesticated by humans. Insects are consumed as food in 80% of the world\'s nations, by people in roughly 3000 ethnic groups"}',
                'is_public' => false,
                'image' => NULL,
                'scope_id' => 7,
                'owner_id' => 1,
                'created_at' => '2022-11-09 05:09:34',
                'updated_at' => '2022-11-12 02:31:09',
            ),
            22 => 
            array (
                'id' => 27,
                'name' => '{"en":"Brown Sloth"}',
                'desc' => '{"en":"This cat-sized mammal, typically weighing 8 – 9 pounds, has a round head, a short snout, small eyes, long legs, tiny ears, and a stubby tail. Sloths have long, coarse fur that is light brown in color but often appears green due to the blue-green algae that grow there. Instead of toes, their front and hind feet have three curved claws that allow them to easily hook onto tree branches and hang upside-down. Sloths can rotate their heads nearly 90 degrees, and their mouths are shaped so they look like they are always smiling.\\r\\n\\r\\nTheir algae-covered fur helps camouflage the sloth in its forest environment. Sloths spend nearly all of their time in trees, descending to the ground only once a week to defecate.\\r\\n\\r\\nSloths are among the slowest-moving animals on Earth; they can swim but are virtually unable to walk. This makes them an easy target for jaguars, eagles, and people that hunt sloths for their meat."}',
                'is_public' => false,
                'image' => 'Ia6saaiCLY490Tzug5xoc69if21dYC0HOBf62OQH.jpg',
                'scope_id' => 12,
                'owner_id' => 1,
                'created_at' => '2022-11-12 02:48:34',
                'updated_at' => '2022-11-12 02:49:41',
            ),
            23 => 
            array (
                'id' => 23,
                'name' => '{"en":"Item"}',
                'desc' => '{"en":null}',
                'is_public' => true,
                'image' => NULL,
                'scope_id' => 24,
                'owner_id' => 1,
                'created_at' => '2022-11-10 23:58:28',
                'updated_at' => '2022-11-12 04:53:40',
            ),
            24 => 
            array (
                'id' => 24,
                'name' => '{"en":"Place"}',
                'desc' => '{"en":null}',
                'is_public' => true,
                'image' => NULL,
                'scope_id' => 5,
                'owner_id' => 1,
                'created_at' => '2022-11-10 23:59:46',
                'updated_at' => '2022-11-12 04:56:01',
            ),
            25 => 
            array (
                'id' => 19,
                'name' => '{"en":"Rest"}',
                'desc' => '{"en":"From time to time everyone needs to rest, even the hero. At the same time, he can switch to some practice."}',
                'is_public' => true,
                'image' => NULL,
                'scope_id' => 19,
                'owner_id' => 1,
                'created_at' => '2022-11-10 14:37:54',
                'updated_at' => '2022-11-12 04:59:41',
            ),
            26 => 
            array (
                'id' => 29,
                'name' => '{"en":"Capybara"}',
                'desc' => '{"en":"Capybaras are the largest rodents on earth. They have a heavy, barrel-shaped body that sits on relatively squat legs, shorter in the front than the back. Their brown fur is coarse and sparse enough to reveal the grey skin beneath it.\\r\\n\\r\\nCapybaras have partially webbed feet, which help to propel them through the water or swampy areas. Similar to a hippopotamus, the capybara’s eyes, nose, and ears are located on the top of its head, allowing it to peek above the surface for a breath of air and a quick check for predators while the bulk of its body remains hidden beneath the water.\\r\\n\\r\\nThey are semi-aquatic and will spend most of their time in dense vegetation around rivers, lakes, ponds, marshes, and swamps. Feeding mostly in the afternoon, and on and off at night, capybaras tend to doze in the morning. They take short naps throughout the day while other members of their group stand guard.\\r\\n\\r\\nThey are herbivores and eat the vegetation that lines water sources and other aquatic plants. They also eat their own poop, which contains beneficial bacteria that helps their stomach to break down the fiber from the grass. During the dry season or in drought conditions, capybaras will also eat grains, melons, reeds and squashes.\\r\\n\\r\\nCapybaras are naturally threatened by jaguars, caimans and anacondas, and their young can be taken by ocelots and harpy eagles."}',
                'is_public' => false,
                'image' => '4TGnMBEBJrTHKhjJurd7rupbVf30jnagpJlECi4j.png',
                'scope_id' => 12,
                'owner_id' => 1,
                'created_at' => '2022-11-12 03:22:02',
                'updated_at' => '2022-11-12 03:22:02',
            ),
            27 => 
            array (
                'id' => 25,
                'name' => '{"en":"Mountain Gorilla"}',
                'desc' => '{"en":"Mountain gorillas are the largest living primates on earth! They can move on their two feet, on all four of their limbs, and can also climb trees and even swing from branches. Mountain gorillas, along with chimpanzees, orangutans, and bonobos, are the closest living relatives of humans, with mountain gorillas having the most developed brain of the four.\\r\\n\\r\\nMountain gorillas live in groups of roughly 30, with one dominant, male troop leader called a ‘silverback’ for the silver tint in his coat. The dominant silverback is in charge of coordinating when the troop eats, rests, and moves around the group’s home range, and the rest of the group is organized in a complex, evolved social order that points to the mountain gorilla’s extraordinary intelligence.\\r\\n\\r\\nMountain gorillas are primarily herbivores and they eat large portions of over 100 different kinds of plants. They do not drink much water because they get most of their needed hydration from their constant consumption of plants."}',
                'is_public' => false,
                'image' => 'l3y3Rr27v9fHC8Up2ojegcx2YdmkpJ5OoBy56k03.jpg',
                'scope_id' => 12,
                'owner_id' => 1,
                'created_at' => '2022-11-12 01:35:45',
                'updated_at' => '2022-11-12 04:13:27',
            ),
            28 => 
            array (
                'id' => 30,
                'name' => '{"en":"Scarlet Macaw"}',
                'desc' => '{"en":"Macaws are the largest parrots in the world! This beautiful macaw has a creamy white, almost featherless face, with bright red plumage covering most of its body, wings, and long tail. Brilliant blue and yellow feathers also adorn the lower wings. The bird’s strong beak is adapted to breaking hard nuts found in the rainforest.\\r\\n\\r\\nThey prefer to spend their time in tall, deciduous trees in forests and near rivers, usually in large, noisy groups. Macaws also mate for life, nesting from January through April in the holes of dead canopy trees. Mated adults lay up to two eggs per year, and preen each other and their offspring for hours, cleaning bugs from their feathers.\\r\\n\\r\\nNuts, leaves, berries and seeds from the rainforest make up the bulk of the scarlet macaw’s diet. Its strong, hooked beak is perfect for breaking nuts and seeds. Interestingly, the scarlet macaw can eat fruits toxic enough to kill other animals. This could be because they also eat large amounts of clay, which is thought to neutralize plant poisons."}',
                'is_public' => false,
                'image' => 'Jq108MbkcrlwQTFDsW2oJiGoTkOdXIRPIlh6FxwD.jpg',
                'scope_id' => 6,
                'owner_id' => 1,
                'created_at' => '2022-11-12 04:20:48',
                'updated_at' => '2022-11-12 04:20:48',
            ),
            29 => 
            array (
                'id' => 16,
                'name' => '{"en":"Bird","ru":"Встреча - Птица"}',
                'desc' => '{"en":"Birds are a group of warm-blooded vertebrates, characterized by feathers, toothless beaked jaws, the laying of hard-shelled eggs, a high metabolic rate, a four-chambered heart, and a strong yet lightweight skeleton. Birds live worldwide and range in size from the bee hummingbird to the ostrich. There are about ten thousand living species, more than half of which are passerine, or \\"perching\\" birds.\\r\\n\\r\\nMany social species pass on knowledge across generations, which is considered a form of culture. Birds are social, communicating with visual signals, calls, and songs, and participating in such behaviours as cooperative breeding and hunting, flocking, and mobbing of predators."}',
                'is_public' => false,
                'image' => NULL,
                'scope_id' => 6,
                'owner_id' => 1,
                'created_at' => '2022-11-09 05:10:58',
                'updated_at' => '2022-11-12 04:32:15',
            ),
        ));
        
        
    }
}