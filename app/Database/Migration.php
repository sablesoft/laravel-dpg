<?php

namespace App\Database;

use Illuminate\Database\Migrations\Migration as BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Migration extends BaseMigration
{
    /**
     * @param string $tableName
     * @param callable|null $moreFields
     * @return void
     */
    protected function upContent(string $tableName, callable $moreFields = null) {
        Schema::create($tableName, function (Blueprint $table) use ($moreFields){
            $table->id();
            $table->json('name')->nullable(false);
            $table->json('desc')->nullable(true);
            $table->boolean('is_public')->nullable(false)->default(false);
            $table->string('image')->nullable(true);
            $table->foreignId('scope_id')->nullable(true)
                ->constrained('cards')->cascadeOnUpdate()->nullOnDelete();
            if ($moreFields) {
                $moreFields($table);
            }
            $table->foreignId('owner_id')->nullable(false)
                ->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * @param string $tableName
     * @param callable|null $moreFields
     * @return void
     */
    protected function upFromDeck(string $tableName, callable $moreFields = null) {
        Schema::create($tableName, function (Blueprint $table) use ($moreFields){
            $table->id();
            $table->foreignId('game_id')->nullable(false)
                ->constrained('games')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('deck_id')->nullable(false)
                ->constrained('decks')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('card_id')->nullable(false)
                ->constrained('cards')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('scope_id')->nullable(false)
                ->constrained('cards')->cascadeOnUpdate()->cascadeOnDelete();
            $table->longText('desc')->nullable(true);
            if ($moreFields) {
                $moreFields($table);
            }
            $table->unique(['game_id', 'deck_id']);
            $table->unique(['game_id', 'card_id', 'scope_id']);
            $table->timestamps();
        });
    }
}
