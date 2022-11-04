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
        Schema::create('deck_adventure', function (Blueprint $table) {
            $table->foreignId('deck_id');
            $table->foreignId('adventure_id');

            $table->foreign('deck_id')->references('id')->on('decks');
            $table->foreign('adventure_id')->references('id')->on('adventures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deck_adventure');
    }
};
