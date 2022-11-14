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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->nullable(false)
                ->constrained('games')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('stack_id')->nullable(false)
                ->constrained('stacks')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('card_id')->nullable(false)
                ->constrained('cards')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('logs');
    }
};
