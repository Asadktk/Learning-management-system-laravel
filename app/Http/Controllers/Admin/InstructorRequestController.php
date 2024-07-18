<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Request as RequestModel;
use Illuminate\Http\Request as HttpRequest; 

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

    public function accept($id): JsonResponse
    {
        try {
            $requestRecord = RequestModel::findOrFail($id);
            $requestRecord->assignCourseToInstructor();

            return response()->json(['status' => 'Request accepted and instructor assigned to course successfully.']);
        } catch (\Exception $e) {
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
