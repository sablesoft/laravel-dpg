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
        Schema::create('game_book', function (Blueprint $table) {
            $table->foreignId('game_id')->constrained('games')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('book_id')->constrained('books')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->unique(['game_id', 'book_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_book');
    }
};
