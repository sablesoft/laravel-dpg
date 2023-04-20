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
        Schema::create('guide_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topic_id')->nullable(false)
                ->constrained('guide_topics')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('post_id')->nullable(false)
                ->constrained('guide_posts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('project_id')->nullable(false)
                ->constrained('guide_projects')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('owner_id')->nullable(false)
                ->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['post_id', 'topic_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('guide_tags');
    }
};
