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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->json('name')->nullable(true);
            $table->json('desc')->nullable(true);
            $table->string('image')->nullable(true);
            $table->foreignId('quest_id')->nullable(true)
                ->constrained('cards')->nullOnDelete();
            $table->foreignId('owner_id')->nullable(false)->constrained('users')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('process_id')->nullable(true);
            $table->boolean('is_public')->nullable(false)->default(false);
            $table->string('board_image')->nullable(true);
            $table->string('cards_back')->nullable(true);
            $table->unsignedSmallInteger('status')->nullable(false)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
};
