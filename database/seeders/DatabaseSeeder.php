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
        $this->call(TagsTableSeeder::class);
        $this->call(CardsTableSeeder::class);
        $this->call(CardTagTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(BookTagTableSeeder::class);
        $this->call(BookCardTableSeeder::class);
        $this->call(DecksTableSeeder::class);
        $this->call(DeckCardTableSeeder::class);
        $this->call(DeckTagTableSeeder::class);
        $this->call(SequencesSeeder::class);
    }
}
