<?php

namespace App\Database;

use Illuminate\Database\Migrations\Migration as BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Migration extends BaseMigration
{
    /**
     * @param string $tableName
     * @param callable|null $moreFields
     * @return void
     */
    protected function upContent(string $tableName, callable $moreFields = null) {
        Schema::create($tableName, function (Blueprint $table) use ($moreFields){
            $table->id();
            $table->text('name')->nullable(false);
            $table->text('desc')->nullable(true);
            $table->boolean('is_public')->nullable(false)->default(false);
            $table->string('image')->nullable(true);
            $table->foreignId('scope_id')->nullable(true)
                ->constrained('tags')->cascadeOnUpdate()->nullOnDelete();
            if ($moreFields) {
                $moreFields($table);
            }
            $table->foreignId('owner_id')->nullable(false)
                ->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }
}
