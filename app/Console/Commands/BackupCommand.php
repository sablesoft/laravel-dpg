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
        'tags',
        'cards',
        'tag_card',
        'decks',
        'tag_deck',
        'card_deck',
        'adventures',
        'tag_adventure'
    ];

    protected string $lastTable = 'deck_adventure';

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
