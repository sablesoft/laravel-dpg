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
                ->constrained('domes')->nullOnDelete();
            $table->unsignedInteger('top_step')->nullable(true);
            $table->unsignedInteger('top')->nullable(true);
            $table->unsignedInteger('left_step')->nullable(true);
            $table->unsignedInteger('left')->nullable(true);
            $table->json('markers')->nullable(true);

            $table->unique(['dome_id', 'scope_id', 'owner_id']);
            $table->unique(['dome_id', 'top', 'left', 'owner_id']);
            $table->unique(['dome_id', 'top_step', 'left_step', 'owner_id']);
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
