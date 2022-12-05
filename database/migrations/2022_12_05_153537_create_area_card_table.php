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
        Schema::create('area_card', function (Blueprint $table) {
            $table->foreignId('area_id')->constrained('areas')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('card_id')->constrained('cards')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->unique(['area_id', 'card_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area_card');
    }
};
