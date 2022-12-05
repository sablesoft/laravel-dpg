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
        Schema::create('book_dome', function (Blueprint $table) {
            $table->foreignId('book_id')->constrained('books')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('dome_id')->constrained('domes')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->unique(['book_id', 'dome_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_dome');
    }
};
