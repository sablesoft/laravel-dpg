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
        'book_card',
        'book_subscriber',
        'decks',
        'deck_card',
        'games',
        'game_card',
        'game_subscriber',
        'sets',
        'set_card',
        'stacks',
        'uniques'
    ];

    protected string $lastTable = 'deck_tag';

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
