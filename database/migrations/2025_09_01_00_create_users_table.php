<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('users')) {
            try {
                Schema::create('users', function (Blueprint $table) {

                    $table->id();
                    $table->foreignId('created_by_user_id')->nullable()->constrained('users')->nullOnDelete();
                    $table->foreignId('updated_by_user_id')->nullable()->constrained('users')->nullOnDelete();
                    $table->foreignId('deleted_by_user_id')->nullable()->constrained('users')->nullOnDelete();
                    $table->timestamps();
                    $table->softDeletes();
                });
            } catch (\Exception $e) {
                $this->down();
                throw $e;
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
