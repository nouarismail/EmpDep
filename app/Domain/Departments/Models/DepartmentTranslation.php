<?php
namespace App\Domain\Departments\Models;

use App\Domain\TranslationLanguage\Models\TranslationLanguage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class DepartmentTranslation extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function language()
    {
        return $this->belongsTo(TranslationLanguage::class, 'translation_language_id');
    }
}
