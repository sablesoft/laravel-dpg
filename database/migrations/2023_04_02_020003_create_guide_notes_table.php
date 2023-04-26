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
        Schema::create('guide_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->nullable(false)
                ->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('project_id')->nullable(true)
                ->constrained('guide_projects')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('module_id')->nullable(true)
                ->constrained('guide_modules')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('post_id')->nullable(true)
                ->constrained('guide_posts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('topic_id')->nullable(false)
                ->constrained('guide_topics')->cascadeOnUpdate()->cascadeOnDelete();
            $table->text('text')->nullable(true);
            $table->unsignedSmallInteger('number')->nullable(true);
            $table->timestamps();

            $table->unique(['project_id', 'module_id', 'post_id', 'topic_id']);
            $table->unique(['project_id', 'module_id',  'post_id', 'number']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('guide_notes');
    }
};
