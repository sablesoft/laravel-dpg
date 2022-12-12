<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Database\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->upContent('domes', function (Blueprint $table) {
            $table->decimal('area_width')->nullable(true);
            $table->decimal('area_height')->nullable(true);
            $table->decimal('map_width')->nullable(true);
            $table->decimal('map_height')->nullable(true);
            $table->decimal('top_step')->nullable(true);
            $table->decimal('left_step')->nullable(true);
            $table->json('area_mask')->nullable(true);
            $table->unique(['scope_id', 'owner_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('domes');
    }
};
