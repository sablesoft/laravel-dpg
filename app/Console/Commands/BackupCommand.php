<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup data as seeds';

    /**
     * @var array|string[]
     */
    protected array $tables = [
        'languages',
        'users',
        'roles',
        'model_has_roles',
        'cards',
        'card_tag',
        'books',
        'book_subscriber',
        'domes',
        'book_dome',
        'areas',
        'lands',
        'land_area',
        'scenes',
        'scene_relation',
        'decks',
        'deck_tag',
        'source_relation',
        'card_relation',
        'games',
        'game_hero',
        'game_book',
    ];

    protected string $lastTable = 'game_subscriber';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        foreach ($this->tables as $table) {
            $this->call("iseed", [
                'tables' => $table,
                '--dumpauto' => false,
                '--force' => true
            ]);
        }

        // dump autoload:
        $table = $this->lastTable;
        $this->call("iseed", [
            'tables' => $table,
            '--force' => true
        ]);

        /** @noinspection PhpClassConstantAccessedViaChildClassInspection */
        return Command::SUCCESS;
    }
}
