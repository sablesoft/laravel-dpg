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
        Schema::create('deck_tag', function (Blueprint $table) {
            $table->foreignId('deck_id')->nullable(false)
                ->constrained('decks')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('tag_id')->nullable(false)
                ->constrained('cards')->cascadeOnUpdate()->cascadeOnDelete();

            $table->unique(['deck_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deck_tag');
    }
};
