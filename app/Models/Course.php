<?php

namespace App\Models;

use App\Models\Period;
use App\Models\Instructor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function instructors()
    {
        return $this->belongsToMany(Instructor::class, 'instructor_courses');
    }

    public function periods()
    {
        return $this->hasMany(Period::class);
    }

    public function instructorCourses()
    {
        return $this->hasMany(InstructorCourse::class);
    }

    public function enrollments()
    {
        return $this->hasManyThrough(Enrollment::class, InstructorCourse::class, 'course_id', 'instructor_course_id', 'id', 'id');
    }
}
