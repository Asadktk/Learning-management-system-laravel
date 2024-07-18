<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use Illuminate\View\View;
use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Traits\InstructorTrait;
use App\Traits\ValidationTrait;
use App\Models\InstructorCourse;
use App\Traits\AttachmentsTrait;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    use ValidationTrait, InstructorTrait, AttachmentsTrait;

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
        $instructors = $this->getInstructors();
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
        $attributes = $this->validateCourse($request);

        $course = Course::create($attributes);
       
        $this->attachInstructors($course, $request->instructor_ids);

        return $course
            ? redirect()->route('admin.courses.display')->with('success', 'Course created successfully.')
            : back()->withErrors('Failed to create course.');
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
        $instructors = $this->getInstructors();
        return view('admin.courses.edit', compact('course', 'instructors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $attributes = $this->validateCourse($request, $id);

        $course = Course::withTrashed()->findOrFail($id);

        $course->update($attributes);


        return redirect()->route('admin.courses.display')->with('success', 'Course updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $course = Course::findOrFail($id);
            $course->forceDelete();
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
