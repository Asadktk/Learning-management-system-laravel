<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Models\InstructorCourse;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $courses = Course::withTrashed()->get();

        return DataTables::of($courses)->make(true);
    }

    public function display(): View
    {
        return view('admin.courses.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $instructors = Instructor::with('user')->get();
        return view(
            'admin.courses.create',
            [
                'instructors' => $instructors,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes =  $request->validate([
            'title' => 'required|string|max:255|unique:courses,title,',
            'description' => 'required|string',
            'fee' => 'required|numeric',
            'available_seat' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $course = Course::create($attributes);

        if ($course) {
            if ($request->has('instructor_ids')) {
                foreach ($request->instructor_ids as $instructor_id) {
                    InstructorCourse::create([
                        'instructor_id' => $instructor_id,
                        'course_id' => $course->id,
                    ]);
                }
            }

            return redirect()->route('display')->with('success', 'Course created successfully.');
        } else {
            return back()->withErrors('Failed to create course.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::with(['instructors', 'instructors.user'])->withTrashed()->findOrFail($id);
        return view('admin.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::with(['instructors'])->withTrashed()->findOrFail($id);
        $instructors = Instructor::with('user')->get();

        return view('admin.courses.edit', compact('course', 'instructors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate request data
        $attributes = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'fee' => 'required|numeric',
            'available_seat' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            // Add validation for instructor_ids if needed
        ]);

        // Find the course to update
        $course = Course::withTrashed()->findOrFail($id);

        // Update the course attributes
        $course->update($attributes);

    
        // Redirect with success message
        return redirect()->route('display')->with('success', 'Course updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $course = Course::findOrFail($id);
            $course->forceDelete(); // Perform a hard delete
            return response()->json(['message' => 'Course deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Course deletion failed: ' . $e->getMessage()], 500);
        }
    }

    public function block($id)
    {
        $course = Course::withTrashed()->find($id);
        $course->delete();
        return response()->json(['status' => 'Course blocked successfully']);
    }

    public function unblock($id)
    {
        $course = Course::withTrashed()->find($id);
        $course->restore();
        return response()->json(['status' => 'Course unblocked successfully']);
    }
}
