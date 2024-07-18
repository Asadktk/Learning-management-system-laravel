<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function index(): JsonResponse
    {
        $students = Student::with(['user'])
            ->withTrashed()
            ->get();

        return DataTables::of($students)
            ->make(true);
    }

    public function display(): View
    {
        return view('admin.students.index');
    }


    public function show(string $id)
    {
        $student = Student::with(['user', 'enrollments.instructorCourse.course', 'enrollments.instructorCourse.instructor.user'])
            ->withTrashed()
            ->findOrFail($id);

        return view('admin.students.show', compact('student'));
    }



    public function destroy($id)
    {
        try {
            $student = Student::withTrashed()->findOrFail($id);

            $student->forceDelete();
            $student->user()->forceDelete();

            return response()->json(['message' => 'student and user deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'student deletion failed: ' . $e->getMessage()], 500);
        }
    }

    public function block($id)
    {
        $student = Student::withTrashed()->find($id);
        $student->delete();
        return response()->json(['status' => 'Student blocked successfully']);
    }

    public function unblock($id)
    {
        $student = Student::withTrashed()->find($id);
        $student->restore();
        return response()->json(['status' => 'Student unblocked successfully']);
    }
}
