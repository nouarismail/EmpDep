<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('cache')) {
            try {
                Schema::create('cache', function (Blueprint $table) {
                    $table->string('key')->primary();
                    $table->mediumText('value');
                    $table->integer('expiration');
                });
            } catch (\Exception $e) {
                $this->down();
                throw $e;
            }
        }

        if (! Schema::hasTable('cache_locks')) {
            try {
                Schema::create('cache_locks', function (Blueprint $table) {
                    $table->string('key')->primary();
                    $table->string('owner');
                    $table->integer('expiration');
                });
            } catch (\Exception $e) {
                $this->down();
                throw $e;
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};
