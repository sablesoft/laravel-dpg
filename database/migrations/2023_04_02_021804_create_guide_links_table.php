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
    public function up(): void
    {
        Schema::create('guide_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('number')->nullable(false);
            $table->foreignId('owner_id')->nullable(false)
                ->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('post_id')->nullable(true)
                ->constrained('guide_posts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('note_id')->nullable(true)
                ->constrained('guide_notes')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('target_category_id')->nullable(false)
                ->constrained('guide_topics')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('target_post_id')->nullable(false)
                ->constrained('guide_posts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('target_note_id')->nullable(true)
                ->constrained('guide_notes')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['post_id', 'number']);
            $table->unique(['note_id', 'number']);
            $table->unique(['post_id', 'target_category_id', 'target_post_id', 'target_note_id']);
            $table->unique(['note_id', 'target_category_id', 'target_post_id', 'target_note_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('guide_links');
    }
};
