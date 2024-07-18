<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Period;
use App\Models\Student;
use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $studentCount = Student::count();
        $courseCount = Course::count();
        $eventCount = Period::count();
        $trainerCount = Instructor::count();
        return view('admin.home', compact('studentCount', 'courseCount', 'eventCount', 'trainerCount'));
    }
}
