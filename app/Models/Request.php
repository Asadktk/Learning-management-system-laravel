<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Instructor;
use App\Models\InstructorCourse;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Request extends Model
{
    use HasFactory;

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function assignCourseToInstructor(): void
    {
        DB::transaction(function () {
            InstructorCourse::create([
                'instructor_id' => $this->instructor_id,
                'course_id' => $this->course_id,
            ]);

            $this->delete();
        });
    }
}
