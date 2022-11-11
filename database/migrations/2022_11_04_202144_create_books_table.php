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
        $this->upContent('books', function(Blueprint $table) {
            $table->foreignId('hero_id')->nullable(true)
                ->constrained('cards')->nullOnDelete();
            $table->foreignId('quest_id')->nullable(true)
                ->constrained('cards')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
