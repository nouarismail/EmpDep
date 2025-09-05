<?php

namespace App\Domain\Employees\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Domain\Departments\Models\Department;
use Database\Factories\EmployeeFactory;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

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
    protected static function newFactory()
    {
        return EmployeeFactory::new();
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_employee')
                    ->withPivot(['from_date', 'to_date'])
                    ->withTimestamps();
    }
}