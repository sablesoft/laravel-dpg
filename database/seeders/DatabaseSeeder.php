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
        $this->call(RolesTableSeeder::class);
        $this->call(ModelHasRolesTableSeeder::class);
        $this->call(CardsTableSeeder::class);
        $this->call(CardTagTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(BookCardTableSeeder::class);
        $this->call(BookSubscriberTableSeeder::class);
        $this->call(DecksTableSeeder::class);
        $this->call(DeckCardTableSeeder::class);
        $this->call(DeckTagTableSeeder::class);
        $this->call(GamesTableSeeder::class);
        $this->call(GameHeroTableSeeder::class);
        $this->call(GameBookTableSeeder::class);
        $this->call(GameSubscriberTableSeeder::class);
        $this->call(SetsTableSeeder::class);
        $this->call(SetCardTableSeeder::class);
        $this->call(StacksTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(DomesTableSeeder::class);
        $this->call(DomeCardTableSeeder::class);
        $this->call(BookDomeTableSeeder::class);
        $this->call(BookSourceTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(AreaCardTableSeeder::class);
        $this->call(SequencesSeeder::class);
    }
}
