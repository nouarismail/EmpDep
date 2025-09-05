<?php

namespace App\Observers;

use App\Domain\Departments\Models\Department;

class DepartmentObserver
{
    /**
     * Handle the Department "created" event.
     */
    public function creating(Department $department): void
    {
        if (is_null($department->created_by_user_id)) {
            $department->created_by_user_id = 1;
        }
    }

    /**
     * Handle the Department "updated" event.
     */
    public function updated(Department $department): void
    {
        //
    }

    /**
     * Handle the Department "deleted" event.
     */
    public function deleted(Department $department): void
    {
        //
    }

    /**
     * Handle the Department "restored" event.
     */
    public function restored(Department $department): void
    {
        //
    }

    /**
     * Handle the Department "force deleted" event.
     */
    public function forceDeleted(Department $department): void
    {
        //
    }
}
