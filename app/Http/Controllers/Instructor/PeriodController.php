<?php

namespace App\Http\Controllers\Instructor;

use Carbon\Carbon;
use App\Models\Course;
use App\Models\Period;
use Illuminate\View\View;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PeriodController extends Controller
{
    public function index(): JsonResponse
    {
        $instructor = Instructor::where('user_id', Auth::id())->firstOrFail();


        $periods = Period::with('course')
            ->where('instructor_id', $instructor->id)
            ->get();

        return DataTables::of($periods)->make(true);
    }


    public function display(): View
    {
        return view('instructor.classes.index');
    }

    public function create()
    {
        $instructor = Instructor::where('user_id', Auth::id())->firstOrFail();

        $courses = $instructor->courses;
        return view('instructor.classes.create', with([
            'courses' => $courses,
        ]));
    }

    public function store(Request $request)
    {
        $period = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $instructor = Instructor::where('user_id', Auth::id())->firstOrFail();

        $startTime = Carbon::parse($period['start_time']);
        $endTime = Carbon::parse($period['end_time']);

        $overlappingPeriods = Period::where('instructor_id', $instructor->id)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime])
                    ->orWhere(function ($query) use ($startTime, $endTime) {
                        $query->where('start_time', '<=', $startTime)
                            ->where('end_time', '>=', $endTime);
                    });
            })
            ->exists();

        if ($overlappingPeriods) {
            throw ValidationException::withMessages([
                'start_time' => 'This time overlaps with an existing period.',
            ]);
        }

        $period['instructor_id'] = $instructor->id;
        Period::create($period);

        return redirect()->route('instructor.periods.display')->with('success', 'Period created successfully.');
    }

    public function show($id)
    {
        $period = Period::findOrFail($id);

        return view('instructor.classes.show', [
            'period' => $period,
        ]);
    }

    public function edit($id)
    {
        $instructor = Instructor::where('user_id', Auth::id())->firstOrFail();
        $period = Period::findOrFail($id);
        $courses = $instructor->courses;

        return view('instructor.classes.edit', [
            'period' => $period,
            'courses' => $courses,
        ]);
    }

    public function update(Request $request, $id)
    {
        $period = Period::findOrFail($id);

        $validatedData = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $instructor = Instructor::where('id', $period->instructor_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $startTime = Carbon::parse($validatedData['start_time']);
        $endTime = Carbon::parse($validatedData['end_time']);

        $overlappingPeriods = Period::where('instructor_id', $instructor->id)
            ->where('id', '!=', $id)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime])
                    ->orWhere(function ($query) use ($startTime, $endTime) {
                        $query->where('start_time', '<=', $startTime)
                            ->where('end_time', '>=', $endTime);
                    });
            })
            ->exists();

        if ($overlappingPeriods) {
            throw ValidationException::withMessages([
                'start_time' => 'This time overlaps with an existing period.',
            ]);
        }

        $period->update([
            'course_id' => $validatedData['course_id'],
            'start_time' => $validatedData['start_time'],
            'end_time' => $validatedData['end_time'],
        ]);

        return redirect()->route('instructor.periods.display')->with('success', 'Period updated successfully.');
    }

    public function destroy(Period $period)
    {
        $period->forceDelete();
        return response()->json(['message' => 'Period deleted successfully']);
    }
}
