<?php

namespace App\Models;

use App\Models\Student;
use App\Models\InstructorCourse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enrollment extends Model
{
    use HasFactory;

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function instructorCourse()
    {
        return $this->belongsTo(InstructorCourse::class, 'instructor_course_id');
    }
}
