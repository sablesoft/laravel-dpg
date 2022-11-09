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
        Schema::create('tag_book', function (Blueprint $table) {
            $table->foreignId('tag_id')->constrained('tags')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('book_id')->constrained('books')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->unique(['tag_id', 'book_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_book');
    }
};