<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('department_translations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('department_id')
                ->constrained('departments')
                ->cascadeOnDelete();

            $table->foreignId('translation_language_id')
                ->constrained('translation_languages')
                ->cascadeOnDelete();

            $table->string('dept_name', 100);

            // auditing (matches your pattern)
            $table->foreignId('created_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by_user_id')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['department_id', 'translation_language_id']);
            $table->index(['translation_language_id']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('department_translations');
    }
};
