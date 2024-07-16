<?php

namespace App\Http\Controllers\Student;

use App\Models\Course;
use App\Models\Period;
use App\Models\Student;
use App\Models\Enrollment;
use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Models\InstructorCourse;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $studentCount = Student::count();
        $courseCount = Course::count();
        $eventCount = Period::count();
        $trainerCount = Instructor::count();

        $courses = Course::with([
            'instructors.user',
            'enrollments.student'
        ])->get();

        $instructors = Instructor::with('user')->get();

        return view('student.home', compact('courses', 'instructors', 'studentCount', 'courseCount', 'eventCount', 'trainerCount'));
    }

    public function instructors(){
        $instructors = Instructor::with('user')->get();

        return view('student.instructors.index', with([
            'instructors' => $instructors
        ]));
    }

    
}
