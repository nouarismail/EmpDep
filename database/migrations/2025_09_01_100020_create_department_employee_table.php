<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('department_employee')) {
            try {
                Schema::create('department_employee', function (Blueprint $table) {
                    $table->id();

                    $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
                    $table->foreignId('department_id')->constrained('departments')->cascadeOnDelete();
                    $table->date('from_date');
                    $table->date('to_date')->nullable();

                    $table->foreignId('created_by_user_id')->nullable()->constrained('users')->nullOnDelete();
                    $table->foreignId('updated_by_user_id')->nullable()->constrained('users')->nullOnDelete();
                    $table->foreignId('deleted_by_user_id')->nullable()->constrained('users')->nullOnDelete();


                    $table->timestamps();
                    $table->softDeletes();

                    $table->unique(['employee_id', 'department_id']);
                });
            } catch (\Exception $e) {
                $this->down();
                throw $e;
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('department_employee');
    }
};
