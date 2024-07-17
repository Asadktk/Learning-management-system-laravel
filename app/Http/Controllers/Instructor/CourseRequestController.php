<?php

namespace App\Http\Controllers\Instructor;

use App\Models\Course;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Request as CourseRequest;

class CourseRequestController extends Controller
{
    public function create()
    {
        $instructor = Auth::user()->instructor;

        $assignedCourseIds = $instructor->courses()->pluck('courses.id')->toArray();
        $requestedCourseIds = $instructor->courseRequests()->pluck('course_id')->toArray();

        $excludedCourseIds = array_unique(array_merge($assignedCourseIds, $requestedCourseIds));

        $courses = Course::whereNotIn('id', $excludedCourseIds)->get();

        return DataTables::of($courses)->make(true);
    }

    public function display()
    {

        return view('instructor.requests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $instructor = Auth::user()->instructor;

        if ($instructor->courseRequests()->where('course_id', $request->course_id)->exists()) {
            return redirect()->back()->with('error', 'You have already sent a request for this course.');
        }

        $courseRequest = new CourseRequest();
        $courseRequest->instructor_id = $instructor->id;
        $courseRequest->course_id = $request->course_id;
        $courseRequest->save();

        return redirect()->back()->with('success', 'Request sent successfully.');
    }
}
