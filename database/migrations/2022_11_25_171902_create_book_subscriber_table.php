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
        Schema::create('book_subscriber', function (Blueprint $table) {
            $table->foreignId('book_id')->nullable(false)
                ->constrained('books')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('subscriber_id')->nullable(false)
                ->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedSmallInteger('type')
                ->nullable(false)->default(0);

            $table->unique(['book_id', 'subscriber_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_subscriber');
    }
};
