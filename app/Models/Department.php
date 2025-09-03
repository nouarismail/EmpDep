<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes,CascadeSoftDeletes; 

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_user_id',
        'updated_by_user_id',
        'deleted_by_user_id',
    ];

    protected $cascadeDeletes  = ['departmentEmployees'];
    protected $cascadeRestores = ['departmentEmployees'];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'department_employee')
                    ->using(DepartmentEmployee::class)  
                    ->withPivot(['from_date', 'to_date'])
                    ->withTimestamps();
    }

    public function translations()
    {
        return $this->hasMany(DepartmentTranslation::class);
    }

    public function departmentEmployees()
    {
        return $this->hasMany(DepartmentEmployee::class);
    }


    public function translated() 
    {
        $langId = app('translation_language_id') ?? 1;

        return $this->hasOne(DepartmentTranslation::class)
                    ->where('translation_language_id', $langId);
    }

    
    public function getDisplayNameAttribute(): string
    {
        return optional($this->translated)->dept_name ?? $this->dept_name;
    }
}