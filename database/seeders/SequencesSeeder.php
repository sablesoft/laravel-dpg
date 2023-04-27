<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SequencesSeeder extends Seeder
{
    protected array $tables = [
        'languages',
        'users',
        'roles',
        'cards',
        'books',
        'decks',
        'games',
        'domes',
        'areas',
        'scenes',
        'guide_projects',
        'guide_modules',
        'guide_topics',
        'guide_posts',
        'guide_notes',
        'guide_links',
        'guide_tags',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->tables as $table) {
            DB::select("SELECT setval(pg_get_serial_sequence('$table', 'id'), coalesce(MAX(id), 1)) FROM $table");
        }
    }
}
