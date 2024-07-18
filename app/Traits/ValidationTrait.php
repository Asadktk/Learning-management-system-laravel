<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait ValidationTrait
{
    public function validateCourse(Request $request, int $courseId = null): array
    {
        return $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                $courseId ? 'unique:courses,title,' . $courseId : 'unique:courses,title',
            ],
            'description' => 'required|string',
            'fee' => 'required|numeric',
            'available_seat' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);
    }
}
