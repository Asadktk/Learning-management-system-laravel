<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Course;
use App\Models\Request;
use Illuminate\Console\Command;
use App\Mail\InstructorSendRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\InstructorRequestStatus;

class SendCourseRequestEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:course-request-emails';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emails for course requests and their status updates.';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $pendingRequests = Request::where('status', 'pending')->get();
        foreach ($pendingRequests as $request) {
            $admin = User::where('role_id', 1)->first();
            $course = Course::find($request->course_id);
            Mail::to($admin->email)->send(new InstructorSendRequest($admin, $request->instructor->user, $course));
            sleep(1);
        }

        // Example for accepted/rejected requests to instructor
        $processedRequests = Request::whereIn('status', ['accept', 'reject'])->get();
        foreach ($processedRequests as $request) {
            $course = Course::find($request->course_id);
            Mail::to($request->instructor->user->email)->send(new InstructorRequestStatus($request->instructor->user, $course, $request->status));
            sleep(1);
        }

        $this->info('Emails sent successfully.');

    }
}
