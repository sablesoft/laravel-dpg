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
            $table->string('name')->nullable(true);
            $table->longText('desc')->nullable(true);
            $table->foreignId('book_id')->nullable(false)->constrained('books')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('hero_id')->nullable(true)
                ->constrained('cards')->nullOnDelete();
            $table->foreignId('quest_id')->nullable(true)
                ->constrained('cards')->nullOnDelete();
            $table->foreignId('master_id')->nullable(false)->constrained('users')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('board_image')->nullable(true);
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
