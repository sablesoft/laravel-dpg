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
        Schema::create('scene_relation', function (Blueprint $table) {
            $table->foreignId('scene_id')->nullable(false)->constrained('scenes')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('book_id')->nullable(true)->constrained('books')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('dome_id')->nullable(true)->constrained('domes')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('land_id')->nullable(true)->constrained('lands')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('area_id')->nullable(true)->constrained('areas')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->unique(['scene_id', 'book_id', 'dome_id', 'land_id', 'area_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scene_relation');
    }
};
