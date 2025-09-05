<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {

        if (! Schema::hasTable('department_translations')) {
            try {
                Schema::create('department_translations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('department_id')
                ->constrained('departments')
                ->cascadeOnDelete();

            $table->foreignId('translation_language_id')
                ->constrained('translation_languages')
                ->cascadeOnDelete();

            $table->string('dept_name', 100);

            
            $table->foreignId('created_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('deleted_by_user_id')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['department_id', 'translation_language_id'], 'dept_tr_lang_uq');
            $table->index(['translation_language_id']);
        });
            } catch (\Exception $e) {
            $this->down(); 
            throw $e;
        }
        }
        
    }
    public function down(): void {
        Schema::dropIfExists('department_translations');
    }
};
