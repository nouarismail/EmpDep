<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('departments')) {
            try {
                Schema::create('departments', function (Blueprint $table) {
                    $table->id();

                    $table->string('dept_name', 100)->unique();


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
        Schema::dropIfExists('departments');
    }
};
