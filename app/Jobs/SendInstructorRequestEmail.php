<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Course;
use App\Mail\InstructorSendRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\InstructorRequestStatus;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendInstructorRequestEmail implements ShouldQueue
{
    use Queueable;

    public $admin;
    public $instructor;
    public $course;
    /**
     * Create a new job instance.
     */

    public function __construct(User $admin, User $instructor, Course $course)
    {
        $this->admin = $admin;
        $this->instructor = $instructor;
        $this->course = $course;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->admin->email)->send(new InstructorSendRequest($this->admin, $this->instructor, $this->course));

        // Mail::to($this->instructor->email)->send(new InstructorRequestStatus($this->instructor, $this->course, $this->decision));
    }
}
