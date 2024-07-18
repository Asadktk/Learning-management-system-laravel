<?php

namespace App\Traits;

use App\Models\Course;

trait AttachmentsTrait
{
    public function attachInstructors(Course $course, $instructorIds)
    {
        if ($instructorIds) {
            $course->instructors()->attach($instructorIds);
        }
    }
}
