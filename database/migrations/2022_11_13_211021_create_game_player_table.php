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
        Schema::create('game_player', function (Blueprint $table) {
            $table->foreignId('game_id')->nullable(false)
                ->constrained('games')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('player_id')->nullable(false)
                ->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();

            $table->unique(['game_id', 'player_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_player');
    }
};
