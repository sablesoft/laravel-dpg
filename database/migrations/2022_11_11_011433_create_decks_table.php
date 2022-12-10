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
        Schema::create('decks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('card_id')->nullable(false)
                ->constrained('cards')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('scope_id')->nullable(false)
                ->constrained('cards')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedSmallInteger('type')->nullable(false)->default(0);
            $table->json('desc')->nullable(true);
            $table->boolean('is_public')->nullable(false)->default(false);
            $table->string('image')->nullable(true);
            $table->foreignId('owner_id')->nullable(false)
                ->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('book_id')->nullable(true)
                ->constrained('books')->nullOnDelete();
            $table->foreignId('dome_id')->nullable(true)
                ->constrained('domes')->nullOnDelete();
            $table->foreignId('land_id')->nullable(true)
                ->constrained('lands')->nullOnDelete();
            $table->foreignId('area_id')->nullable(true)
                ->constrained('areas')->nullOnDelete();
            $table->foreignId('scene_id')->nullable(true)
                ->constrained('scenes')->nullOnDelete();

            $table->unique([
                'book_id', 'dome_id', 'scene_id',
                'area_id', 'land_id', 'card_id',
                'scope_id', 'owner_id', 'type'
            ]);
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
        Schema::dropIfExists('decks');
    }
};
