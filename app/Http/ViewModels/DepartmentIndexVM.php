<?php
namespace App\Http\ViewModels;

use App\Models\Department;
use Illuminate\Contracts\Support\Arrayable;

class DepartmentIndexVM implements Arrayable
{
    public function getDepartments()
    {
        return Department::with(['translations.language'])->get();
    }

    public function toArray()
    {
        return [
            'departments' => $this->getDepartments()->map(function ($department) {
                return [
                    'id' => $department->id,
                    
                    'default_name' => $department->dept_name,

                    // all translations
                    'translations' => $department->translations->map(function ($t) {
                        return [
                            'id'       => $t->id,
                            'dept_name'=> $t->dept_name,
                            'language' => optional($t->language)->code,
                        ];
                    }),

                    // one translation for current header (if you want it):
                    'current_translation' => optional(
                        $department->translated()->first()
                    )->dept_name,
                ];
            }),
        ];
    }
}
