<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_relation', function (Blueprint $table) {
            $table->foreignId('card_id')->constrained('cards')->nullable(false)
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('game_id')->nullable(true)
                ->constrained('games')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('deck_id')->nullable(true)
                ->constrained('decks')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('book_id')->nullable(true)
                ->constrained('books')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('dome_id')->nullable(true)
                ->constrained('domes')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('land_id')->nullable(true)
                ->constrained('lands')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('area_id')->nullable(true)
                ->constrained('areas')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('scene_id')->nullable(true)
                ->constrained('scenes')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedSmallInteger('count')->nullable(false)->default(1);

            $table->unique([
                'card_id', 'deck_id', 'book_id', 'dome_id',
                'land_id', 'area_id', 'scene_id', 'game_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_relation');
    }
};
