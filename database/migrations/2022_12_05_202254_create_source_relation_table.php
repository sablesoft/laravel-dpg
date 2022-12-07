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
        Schema::create('source_relation', function (Blueprint $table) {
            $table->foreignId('source_id')->nullable(false)
                ->constrained('books')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('book_id')->nullable(true)
                ->constrained('books')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('dome_id')->nullable(true)
                ->constrained('domes')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('area_id')->nullable(true)
                ->constrained('areas')->cascadeOnUpdate()->cascadeOnDelete();


            $table->unique(['source_id', 'book_id', 'dome_id', 'area_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('source_relation');
    }
};
