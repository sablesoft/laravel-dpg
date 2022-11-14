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
        Schema::create('stacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->nullable(false)
                ->constrained('games')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('deck_id')->nullable(false)
                ->constrained('decks')->cascadeOnUpdate()->cascadeOnDelete();

            $table->json('pack')->nullable(true);
            $table->json('discard')->nullable(true);

            $table->unique(['game_id', 'deck_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stacks');
    }
};
