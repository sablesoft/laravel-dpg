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
        Schema::create('guide_projects', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30)->nullable(false);
            $table->string('code', 7)->nullable(false)->unique();
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
        Schema::dropIfExists('guide_projects');
    }
};
