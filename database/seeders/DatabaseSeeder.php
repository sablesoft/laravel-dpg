<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LanguagesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ScopesTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(CardsTableSeeder::class);
        $this->call(TagCardTableSeeder::class);
        $this->call(DecksTableSeeder::class);
        $this->call(TagDeckTableSeeder::class);
        $this->call(CardDeckTableSeeder::class);
        $this->call(AdventuresTableSeeder::class);
        $this->call(TagAdventureTableSeeder::class);
        $this->call(DeckAdventureTableSeeder::class);
    }
}
