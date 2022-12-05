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
        Schema::create('book_source', function (Blueprint $table) {
            $table->foreignId('book_id')->constrained('books')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('source_id')->constrained('books')
                ->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_source');
    }
};
