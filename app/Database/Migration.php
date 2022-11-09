<?php

namespace App\Database;

use Illuminate\Database\Migrations\Migration as BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Migration extends BaseMigration
{
    /**
     * @param string $tableName
     * @return void
     */
    protected function upContent(string $tableName) {
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->foreignId('scope_id')->nullable(true)
                ->constrained('tags')->cascadeOnUpdate()->nullOnDelete();
            $table->string('image')->nullable(true);
            $table->text('name')->nullable(false);
            $table->text('desc')->nullable(true);
            $table->foreignId('owner_id')->nullable(false)
                ->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->boolean('is_public')->nullable(false)->default(false);
            $table->timestamps();
        });
    }
}