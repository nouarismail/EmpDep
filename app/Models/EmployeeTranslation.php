<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeTranslation extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function language()
    {
        return $this->belongsTo(TranslationLanguage::class, 'translation_language_id');
    }
}
