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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scope_id')->nullable(true);
            $table->string('image')->nullable(true);
            $table->text('name')->nullable(false)->unique();
            $table->text('desc')->nullable(true);
            $table->text('private_desc')->nullable(true);
            $table->foreignId('owner_id')->nullable(false);
            $table->boolean('is_public')->nullable(false)->default(false);
            $table->timestamps();

            $table->foreign('scope_id')->references('id')->on('scopes');
            $table->foreign('owner_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
};
