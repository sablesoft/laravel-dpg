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
        Schema::create('land_area', function (Blueprint $table) {
            $table->foreignId('land_id')->constrained('lands')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('area_id')->constrained('areas')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->unique(['land_id', 'area_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('land_area');
    }
};
