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
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->text('desc')->nullable(true);
            $table->foreignId('game_id')->constrained('games')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('card_id')->constrained('cards')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedSmallInteger('status')
                ->nullable(false)->default(0);
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
        Schema::dropIfExists('stories');
    }
};
