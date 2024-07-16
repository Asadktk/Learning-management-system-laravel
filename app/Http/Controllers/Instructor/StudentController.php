<?php

namespace App\Http\Controllers\Instructor;

use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $instructorId = Auth::id(); // Assuming the instructor is authenticated
        $students = Student::select('students.id', 'students.name', 'students.email', 'courses.title as course_title')
            ->join('enrollments', 'students.id', '=', 'enrollments.student_id')
            ->join('instructor_courses', 'enrollments.instructorcourse_id', '=', 'instructor_courses.id')
            ->join('courses', 'instructor_courses.course_id', '=', 'courses.id')
            ->where('instructor_courses.instructor_id', $instructorId)
            ->distinct()
            ->get();

        return DataTables::of($students)
            ->addColumn('action', function ($student) {
                $showRoute = route('instructor.students');
                $blockButton = $student->deleted_at ? 'Unblock' : 'Block';
                $blockClass = $student->deleted_at ? 'unblock-student' : 'block-student';
                return '
                    <a href="' . $showRoute . '" class="btn btn-info btn-sm">View</a>
                    <button data-id="' . $student->id . '" class="btn btn-danger btn-sm ' . $blockClass . '">' . $blockButton . '</button>
                    <button data-id="' . $student->id . '" class="btn btn-warning btn-sm delete-student">Delete</button>
                ';
            })
            ->make(true);
    }
}
