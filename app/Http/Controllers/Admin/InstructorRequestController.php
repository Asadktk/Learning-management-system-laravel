<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Jobs\SendAdminDecisionEmail;
use Illuminate\Support\Facades\Mail;
use App\Mail\InstructorRequestStatus;
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
            $requestRecord = Request::findOrFail($id);
            $requestRecord->assignCourseToInstructor();

            $course = Course::find($requestRecord->course_id);
            // Mail::to($requestRecord->instructor->user->email)->send(new InstructorRequestStatus($requestRecord->instructor->user, $course, 'accepted'));
            SendAdminDecisionEmail::dispatch($requestRecord->instructor->user, $course, 'accepted');


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

            $course = Course::find($request->course_id);
            SendAdminDecisionEmail::dispatch($request->instructor->user, $course, 'rejected');

            // Send email to instructor
            // Mail::to($request->instructor->user->email)->send(new InstructorRequestStatus($request->instructor->user, $course, 'rejected'));
        }
        return response()->json(['status' => 'success']);
    }
}
