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
        Schema::create('card_deck', function (Blueprint $table) {
            $table->foreignId('card_id');
            $table->foreignId('deck_id');
            $table->unsignedSmallInteger('count')->nullable(false)->default(1);

            $table->foreign('card_id')->references('id')
                ->on('cards')->cascadeOnDelete();
            $table->foreign('deck_id')->references('id')
                ->on('decks')->cascadeOnDelete();
            $table->unique(['card_id', 'deck_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_deck');
    }
};
