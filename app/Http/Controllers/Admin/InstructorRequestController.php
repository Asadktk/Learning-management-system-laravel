<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use App\Models\InstructorCourse;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Request as RequestModel; // Alias the model
use Illuminate\Http\Request as HttpRequest; // Alias the HTTP request

class InstructorRequestController extends Controller
{
    public function index(HttpRequest $request): JsonResponse
    {
        if ($request->ajax()) {
            $requests = RequestModel::with(['instructor.user', 'course'])->where('status', 'pending')->get();

            return DataTables::of($requests)
                ->addColumn('instructor', function ($request) {
                    return $request->instructor->user->name;
                })
                ->addColumn('course', function ($request) {
                    return $request->course->title;
                })
                ->addColumn('actions', function ($request) {
                    return '
                        <button class="btn btn-success btn-sm" onclick="handleRequestAction(' . $request->id . ', \'accept\')">Accept</button>
                        <button class="btn btn-danger btn-sm" onclick="handleRequestAction(' . $request->id . ', \'reject\')">Reject</button>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.requests.index');
    }

    public function display(): View
    {
        return view('admin.requests.index');
    }

    public function accept($id)
    {
        try {
            DB::beginTransaction();

            $requestRecord = RequestModel::findOrFail($id);
            $instructorId = $requestRecord->instructor_id;
            $courseId = $requestRecord->course_id;

            InstructorCourse::create([
                'instructor_id' => $instructorId,
                'course_id' => $courseId,
            ]);

            $requestRecord->delete();

            DB::commit();

            return response()->json(['status' => 'Request accepted and instructor assigned to course successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to accept request: ' . $e->getMessage()], 500);
        }
    }

    public function reject($id)
    {
        $request = RequestModel::find($id);
        if ($request) {
            $request->status = 'reject';
            $request->save();
        }
        return response()->json(['status' => 'success']);
    }
}
