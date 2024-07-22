<?php
namespace App\Services;

use App\Models\Instructor;
use App\Models\Period;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class PeriodService
{
    public function getInstructor($userId)
    {
        return Instructor::where('user_id', $userId)->firstOrFail();
    }

    public function checkForOverlappingPeriods($instructorId, $startTime, $endTime, $periodId = null)
    {
        $startTime = Carbon::parse($startTime);
        $endTime = Carbon::parse($endTime);

        $overlappingPeriods = Period::where('instructor_id', $instructorId)
            ->when($periodId, function ($query, $periodId) {
                return $query->where('id', '!=', $periodId);
            })
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
    }

    public function createPeriod($periodData, $instructorId)
    {
        $periodData['instructor_id'] = $instructorId;
        Period::create($periodData);
    }

    public function updatePeriod($periodData, $period)
    {
        $period->update($periodData);
    }

    public function getCourses($instructorId)
    {
        $instructor = Instructor::findOrFail($instructorId);
        return $instructor->courses;
    }

    public function getPeriodsWithCourses($instructorId)
    {
        return Period::with('course')
            ->where('instructor_id', $instructorId)
            ->get();

            
    }
}
