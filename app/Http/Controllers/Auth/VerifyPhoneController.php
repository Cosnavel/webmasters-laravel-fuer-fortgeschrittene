<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class VerifyPhoneController extends Controller
{
    public function create()
    {
        return view('auth.verify_phone');
    }

    public function store(Request $request)
    {
        $request->validate([
            'verification_code' => 'required'
        ]);

        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
        $verification = $twilio->verify->v2->services(env('TWILIO_SERVICE_ID'))->verificationChecks->create($request->verification_code, array('to' => request()->user()->phone_number));

        if ($verification->valid) {
            $request->user()->markPhoneAsVerified();
            return redirect()->route('home');
        }
        return back()->with(['error' => 'invalid verification code']);
    }
}
