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
        $this->upContent('areas', function (Blueprint $table) {
            $table->foreignId('dome_id')->nullable(false)
                ->constrained('domes')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('card_id')->nullable(false)
                ->constrained('cards')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedInteger('top_step')->nullable(true);
            $table->unsignedInteger('top')->nullable(true);
            $table->unsignedInteger('left_step')->nullable(true);
            $table->unsignedInteger('left')->nullable(true);
            $table->json('markers')->nullable(true);

            $table->unique(['dome_id', 'card_id']);
            $table->unique(['top', 'left']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('areas');
    }
};
