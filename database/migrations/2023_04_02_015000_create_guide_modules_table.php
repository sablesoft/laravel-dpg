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
        Schema::create('guide_modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->nullable(false)
                ->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('project_id')->nullable(false)
                ->constrained('guide_projects')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('type_id')->nullable(false)
                ->constrained('guide_topics')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('topic_id')->nullable(false)
                ->constrained('guide_topics')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedSmallInteger('number')->nullable(true);
            $table->timestamps();

            $table->unique(['project_id', 'type_id', 'topic_id']);
            $table->unique(['project_id', 'type_id', 'number']);
        });

        Schema::table('guide_topics', function (Blueprint $table) {
            $table->foreignId('module_id')->nullable(true)
                ->constrained('guide_modules')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumns('guide_topics', ['module_id']);
        Schema::dropIfExists('guide_modules');
    }
};
