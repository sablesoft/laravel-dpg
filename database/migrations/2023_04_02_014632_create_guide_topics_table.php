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
        Schema::create('guide_topics', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->text('text')->nullable(true);
            $table->foreignId('project_id')->nullable(true)
                ->constrained('guide_projects')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('module_id')->nullable(true)
                ->constrained('guide_modules')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('owner_id')->nullable(false)
                ->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['name', 'owner_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('guide_topics');
    }
};
