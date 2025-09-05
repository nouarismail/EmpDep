<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('employees')) {
            try {
                Schema::create('employees', function (Blueprint $table) {

                    $table->id();

                    $table->string('first_name', 50);
                    $table->string('last_name', 50);
                    $table->date('hire_date');


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
        Schema::dropIfExists('employees');
    }
};
