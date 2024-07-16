<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use App\Models\Period;
use App\Models\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Instructor extends Model
{
    use HasFactory, SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'instructor_courses');
    }

    public function periods()
    {
        return $this->hasMany(Period::class);
    }

    public function courseRequests(): HasMany
    {
        return $this->hasMany(Request::class);
    }

    public function instructorCourses()
    {
        return $this->hasMany(InstructorCourse::class);
    }


    
}
