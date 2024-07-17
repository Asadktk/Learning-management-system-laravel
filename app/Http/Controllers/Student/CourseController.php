<?php

namespace App\Http\Controllers\Student;

use App\Models\Course;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Models\InstructorCourse;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{

    public function index(){
        
        $courses = Course::with([
            'instructors.user',
            'enrollments.student'
        ])->get();

        return view('student.courses.index', with([
            'courses' => $courses
        ]));
    }


    public function show($id)
    {
        $course = Course::with(['instructors.user', 'enrollments.student'])
            ->findOrFail($id);

        $availableSeats = $course->available_seat - $course->enrollments->count();

        return view('student.courses.show', compact('course', 'availableSeats'));
    }

    public function create($id)
    {
        $course = Course::with(['instructors.user', 'enrollments.student'])
            ->findOrFail($id);

        $availableSeats = $course->available_seat - $course->enrollments->count();

        return view('student.courses.enroll', compact('course', 'availableSeats'));
    }

    public function store(Request $request, $id)
    {
        $student = auth()->user()->student;
        $course = Course::findOrFail($id);

        // Check available seats
        $availableSeats = $course->available_seat - $course->enrollments->count();
        if ($availableSeats <= 0) {
            return redirect()->back()->with('error', 'no_seats_available');
        }

        // Validate the request data
        $data = $request->validate([
            'instructor_id' => 'required|exists:instructors,id', 
        ]);

        // Fetch all instructor courses for the current course
        $instructorCourses = InstructorCourse::where('course_id', $course->id)
            ->pluck('id');

        // Check if the student is already enrolled in any instructor course for this course
        $isEnrolled = Enrollment::where('student_id', $student->id)
            ->whereIn('instructor_course_id', $instructorCourses)
            ->exists();

        if ($isEnrolled) {
            return redirect()->back()->with('error', 'already_enrolled');
        }

        // Find the specific InstructorCourse for the selected instructor
        $instructorCourse = InstructorCourse::where('course_id', $course->id)
            ->where('instructor_id', $data['instructor_id'])
            ->firstOrFail();

        Enrollment::create([
            'instructor_course_id' => $instructorCourse->id,
            'student_id' => $student->id,
            'enrollment_date' => now(),
        ]);

        return redirect()->back()->with('success', 'enrollment_success');
    }

    public function mycourses(){

        $student = auth()->user()->student;

    $enrollments = Enrollment::with(['instructorCourse.course.instructors.user'])
        ->where('student_id', $student->id)
        ->get();

    return view('student.courses.mycourse', [
        'enrollments' => $enrollments
    ]);
    }
}
