<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decks', function (Blueprint $table) {
            $table->foreignId('deck_id')->constrained('cards')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('card_id')->constrained('cards')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedSmallInteger('count')
                ->nullable(false)->default(1);

            $table->unique(['deck_id', 'card_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('decks');
    }
};
