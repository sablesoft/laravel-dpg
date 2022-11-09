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
            $table->foreignId('deck_id')->constrained('decks')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('adventure_id')->constrained('adventures')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->unique(['deck_id', 'adventure_id']);
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
