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
            $table->foreignId('book_id')->nullable(false)
                ->constrained('books')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('dome_id')->nullable(false)
                ->constrained('domes')->cascadeOnUpdate()->cascadeOnDelete();
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
