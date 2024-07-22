<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {   
    //     $this->middleware('auth');
    //     $this->middleware('signed')->only('verify');
    //     $this->middleware('throttle:6,1')->only('verify', 'resend');
    // }

    public function showVerifyForm()
    {
        return view('emails.verify-otp');
    }

     /**
     * Verify the user's OTP.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'integer', 'digits:6'],
        ]);

        $user = Auth::user();

        if ($user->otp == $request->otp) {
            // OTP is correct, clear it and set email_verified_at
            $user->otp = null;
            $user->email_verified_at = now();
            $user->save();

            return redirect($user->role_id == 2 ? '/instructor/dashboard' : '/');
        } else {
            return redirect()->back()->withErrors(['otp' => 'Invalid OTP']);
        }
    }
}
