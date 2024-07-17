<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\View\View;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class InstructorController extends Controller
{
    public function index(): JsonResponse
    {
        $instructors = Instructor::with(['user', 'courses'])
            ->withTrashed()
            ->get();

        return DataTables::of($instructors)
            ->addColumn('name', function ($instructor) {
                return $instructor->user->name;
            })
            ->addColumn('email', function ($instructor) {
                return $instructor->user->email;
            })
            ->addColumn('courses', function ($instructor) {
                return $instructor->courses->pluck('title')->implode(', ');
            })
            ->make(true);
    }

    public function display(): View
    {
        return view('admin.instructors.index');
    }


    public function show(string $id)
    {
        $instructor = Instructor::with(['user', 'courses'])
            ->withTrashed() 
            ->findOrFail($id); 

        return view('admin.instructors.show', compact('instructor'));
    }



    public function destroy($id)
    {
        try {
            $instructor = Instructor::withTrashed()->findOrFail($id);
            $user = User::withTrashed()->findOrFail($instructor->user_id);

            $instructor->forceDelete(); 
            $user->forceDelete(); 

            return response()->json(['message' => 'Instructor and user deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Instructor deletion failed: ' . $e->getMessage()], 500);
        }
    }

    public function block($id)
    {
        $instructor = Instructor::withTrashed()->find($id);
        $instructor->delete();
        return response()->json(['status' => 'Instructor blocked successfully']);
    }

    public function unblock($id)
    {
        $instructor = Instructor::withTrashed()->find($id);
        $instructor->restore();
        return response()->json(['status' => 'Instructor unblocked successfully']);
    }
}
