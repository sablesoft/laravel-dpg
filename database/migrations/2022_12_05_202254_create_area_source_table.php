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
        Schema::create('area_source', function (Blueprint $table) {
            $table->foreignId('area_id')->constrained('areas')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('source_id')->constrained('books')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->unique(['area_id', 'source_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area_source');
    }
};
