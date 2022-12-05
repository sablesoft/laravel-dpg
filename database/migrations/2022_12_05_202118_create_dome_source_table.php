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
        Schema::create('dome_source', function (Blueprint $table) {
            $table->foreignId('dome_id')->constrained('domes')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('source_id')->constrained('books')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->unique(['dome_id', 'source_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dome_source');
    }
};
