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

            $table->foreign('card_id')->references('id')->on('cards');
            $table->foreign('deck_id')->references('id')->on('decks');
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
