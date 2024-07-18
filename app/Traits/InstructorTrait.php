<?php

namespace App\Traits;

use App\Models\Instructor;

trait InstructorTrait
{
    public function getInstructors()
    {
        return Instructor::with('user')->get();
    }
}
