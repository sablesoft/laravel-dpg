<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SetCardTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('set_card')->delete();
        
        \DB::table('set_card')->insert(array (
            0 => 
            array (
                'set_id' => 1,
                'card_id' => 33,
                'level' => 1,
                'points' => 0,
            ),
            1 => 
            array (
                'set_id' => 1,
                'card_id' => 35,
                'level' => 1,
                'points' => 0,
            ),
            2 => 
            array (
                'set_id' => 2,
                'card_id' => 61,
                'level' => 1,
                'points' => 0,
            ),
            3 => 
            array (
                'set_id' => 3,
                'card_id' => 28,
                'level' => 1,
                'points' => 0,
            ),
            4 => 
            array (
                'set_id' => 3,
                'card_id' => 29,
                'level' => 1,
                'points' => 0,
            ),
            5 => 
            array (
                'set_id' => 3,
                'card_id' => 30,
                'level' => 1,
                'points' => 0,
            ),
            6 => 
            array (
                'set_id' => 3,
                'card_id' => 31,
                'level' => 1,
                'points' => 0,
            ),
            7 => 
            array (
                'set_id' => 3,
                'card_id' => 33,
                'level' => 1,
                'points' => 0,
            ),
            8 => 
            array (
                'set_id' => 3,
                'card_id' => 35,
                'level' => 1,
                'points' => 0,
            ),
            9 => 
            array (
                'set_id' => 4,
                'card_id' => 21,
                'level' => 1,
                'points' => 0,
            ),
            10 => 
            array (
                'set_id' => 4,
                'card_id' => 52,
                'level' => 1,
                'points' => 0,
            ),
            11 => 
            array (
                'set_id' => 4,
                'card_id' => 53,
                'level' => 1,
                'points' => 0,
            ),
            12 => 
            array (
                'set_id' => 4,
                'card_id' => 69,
                'level' => 1,
                'points' => 0,
            ),
            13 => 
            array (
                'set_id' => 4,
                'card_id' => 77,
                'level' => 1,
                'points' => 0,
            ),
            14 => 
            array (
                'set_id' => 5,
                'card_id' => 51,
                'level' => 1,
                'points' => 0,
            ),
            15 => 
            array (
                'set_id' => 6,
                'card_id' => 51,
                'level' => 1,
                'points' => 0,
            ),
            16 => 
            array (
                'set_id' => 6,
                'card_id' => 61,
                'level' => 1,
                'points' => 0,
            ),
            17 => 
            array (
                'set_id' => 7,
                'card_id' => 29,
                'level' => 1,
                'points' => 0,
            ),
            18 => 
            array (
                'set_id' => 7,
                'card_id' => 30,
                'level' => 1,
                'points' => 0,
            ),
            19 => 
            array (
                'set_id' => 7,
                'card_id' => 31,
                'level' => 1,
                'points' => 0,
            ),
            20 => 
            array (
                'set_id' => 7,
                'card_id' => 32,
                'level' => 1,
                'points' => 0,
            ),
            21 => 
            array (
                'set_id' => 7,
                'card_id' => 33,
                'level' => 1,
                'points' => 0,
            ),
            22 => 
            array (
                'set_id' => 7,
                'card_id' => 34,
                'level' => 1,
                'points' => 0,
            ),
            23 => 
            array (
                'set_id' => 7,
                'card_id' => 35,
                'level' => 1,
                'points' => 0,
            ),
            24 => 
            array (
                'set_id' => 7,
                'card_id' => 62,
                'level' => 1,
                'points' => 0,
            ),
            25 => 
            array (
                'set_id' => 8,
                'card_id' => 28,
                'level' => 1,
                'points' => 0,
            ),
            26 => 
            array (
                'set_id' => 8,
                'card_id' => 35,
                'level' => 1,
                'points' => 0,
            ),
            27 => 
            array (
                'set_id' => 10,
                'card_id' => 19,
                'level' => 5,
                'points' => 0,
            ),
            28 => 
            array (
                'set_id' => 10,
                'card_id' => 35,
                'level' => 5,
                'points' => 0,
            ),
            29 => 
            array (
                'set_id' => 12,
                'card_id' => 80,
                'level' => 3,
                'points' => 0,
            ),
            30 => 
            array (
                'set_id' => 12,
                'card_id' => 81,
                'level' => 2,
                'points' => 0,
            ),
            31 => 
            array (
                'set_id' => 12,
                'card_id' => 82,
                'level' => 3,
                'points' => 0,
            ),
            32 => 
            array (
                'set_id' => 13,
                'card_id' => 35,
                'level' => 6,
                'points' => 0,
            ),
            33 => 
            array (
                'set_id' => 14,
                'card_id' => 66,
                'level' => 3,
                'points' => 0,
            ),
            34 => 
            array (
                'set_id' => 15,
                'card_id' => 84,
                'level' => 5,
                'points' => 0,
            ),
            35 => 
            array (
                'set_id' => 16,
                'card_id' => 32,
                'level' => 1,
                'points' => 0,
            ),
            36 => 
            array (
                'set_id' => 16,
                'card_id' => 33,
                'level' => 1,
                'points' => 0,
            ),
            37 => 
            array (
                'set_id' => 16,
                'card_id' => 34,
                'level' => 1,
                'points' => 0,
            ),
            38 => 
            array (
                'set_id' => 16,
                'card_id' => 35,
                'level' => 1,
                'points' => 0,
            ),
            39 => 
            array (
                'set_id' => 16,
                'card_id' => 62,
                'level' => 1,
                'points' => 0,
            ),
            40 => 
            array (
                'set_id' => 17,
                'card_id' => 53,
                'level' => 1,
                'points' => 0,
            ),
            41 => 
            array (
                'set_id' => 17,
                'card_id' => 51,
                'level' => 1,
                'points' => 0,
            ),
            42 => 
            array (
                'set_id' => 18,
                'card_id' => 51,
                'level' => 1,
                'points' => 0,
            ),
            43 => 
            array (
                'set_id' => 19,
                'card_id' => 51,
                'level' => 1,
                'points' => 0,
            ),
        ));
        
        
    }
}