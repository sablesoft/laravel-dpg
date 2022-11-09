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
        Schema::create('tag_adventure', function (Blueprint $table) {
            $table->foreignId('tag_id');
            $table->foreignId('adventure_id');

            $table->foreign('tag_id')->references('id')
                ->on('tags')->cascadeOnDelete();
            $table->foreign('adventure_id')->references('id')
                ->on('adventures')->cascadeOnDelete();
            $table->unique(['tag_id', 'adventure_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_adventure');
    }
};
