<?php

namespace App\Http\Controllers\Instructor;

use App\Models\Period;
use Illuminate\View\View;
use App\Services\PeriodService;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePeriodRequest;

class PeriodController extends Controller
{
    protected $periodService;

    public function __construct(PeriodService $periodService)
    {
        $this->periodService = $periodService;
    }

    public function index(): JsonResponse
    {
        $instructor = $this->periodService->getInstructor(Auth::id());
        $periods = $this->periodService->getPeriodsWithCourses($instructor->id);

        return DataTables::of($periods)->make(true);
    }


    public function display(): View
    {
        return view('instructor.classes.index');
    }


    public function create()
    {
        $instructor = $this->periodService->getInstructor(Auth::id());
        $courses = $this->periodService->getCourses($instructor->id);

        return view('instructor.classes.create', [
            'courses' => $courses,
        ]);
    }

    public function store(StorePeriodRequest $request)
    {
        $periodData = $request->validated();

        $instructor = $this->periodService->getInstructor(Auth::id());

        $this->periodService->checkForOverlappingPeriods($instructor->id, $periodData['start_time'], $periodData['end_time']);

        $this->periodService->createPeriod($periodData, $instructor->id);

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
        $instructor = $this->periodService->getInstructor(Auth::id());
        $period = Period::findOrFail($id);
        $courses = $this->periodService->getCourses($instructor->id);

        return view('instructor.classes.edit', [
            'period' => $period,
            'courses' => $courses,
        ]);
    }

    public function update(StorePeriodRequest $request, $id)
    {
        $period = Period::findOrFail($id);

        $validatedData = $request->validated();

        $instructor = $this->periodService->getInstructor(Auth::id());

        $this->periodService->checkForOverlappingPeriods($instructor->id, $validatedData['start_time'], $validatedData['end_time'], $id);

        $this->periodService->updatePeriod($validatedData, $period);

        return redirect()->route('instructor.periods.display')->with('success', 'Period updated successfully.');
    }

    public function destroy(Period $period)
    {
        $period->forceDelete();
        return response()->json(['message' => 'Period deleted successfully']);
    }
}
