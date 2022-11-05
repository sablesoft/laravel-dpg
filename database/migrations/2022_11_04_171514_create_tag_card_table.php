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
        Schema::create('tag_card', function (Blueprint $table) {
            $table->foreignId('tag_id');
            $table->foreignId('card_id');

            $table->foreign('tag_id')->references('id')->on('tags');
            $table->foreign('card_id')->references('id')->on('cards');
            $table->unique(['tag_id', 'card_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_card');
    }
};
