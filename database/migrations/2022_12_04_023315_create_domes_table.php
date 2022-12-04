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
            $table->foreignId('card_id')->unique()->constrained('cards')
                ->nullOnDelete();
            $table->unsignedInteger('area_width')->nullable(true);
            $table->unsignedInteger('area_height')->nullable(true);
            $table->unsignedInteger('top_step')->nullable(true);
            $table->unsignedInteger('left_step')->nullable(true);
            // todo - other domes settings
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
