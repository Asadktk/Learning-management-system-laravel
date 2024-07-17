<?php

namespace App\Http\Controllers\Instructor;

use App\Models\User;
use App\Models\Student;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

    // public function index()
    // {
    //     $instructorId = Auth::id();


    //     $students = User::with([
    //         'student.enrollments.instructorCourse.course',
    //         'student.enrollments.instructorCourse.instructor'
    //     ])
    //         ->whereHas('student.enrollments.instructorCourse', function ($query) use ($instructorId) {
    //             $query->where('instructor_id', $instructorId);
    //         })
    //         ->get();

    //     return DataTables::of($students)
    //         ->make(true);
    // }

    public function index()
    {
        $instructorId = Auth::id();

        $students = User::with([
            'student.enrollments.instructorCourse.course',
            'student.enrollments.instructorCourse.instructor'
        ])
            ->whereHas('student.enrollments.instructorCourse', function ($query) use ($instructorId) {
                $query->where('instructor_id', $instructorId);
            })
            ->get()
            ->map(function ($user) {
                $user->course_title = $user->student->enrollments->map(function ($enrollment) {
                    return $enrollment->instructorCourse->course->title;
                })->implode(', ');
                return $user;
            });

        return DataTables::of($students)->make(true);
    }



    public function display()
    {
        return view('instructor.students');
    }

}
