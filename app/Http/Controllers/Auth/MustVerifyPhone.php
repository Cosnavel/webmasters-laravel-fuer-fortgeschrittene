<?php

namespace App\Http\Controllers\Auth;

use Twilio\Rest\Client;

trait MustVerifyPhone
{
    public function hasVerifiedPhone()
    {
        return ! is_null($this->phone_number_verified_at);
    }

    public function sendPhoneVerificationToken()
    {
        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
        $twilio->verify->v2->services(env('TWILIO_SERVICE_ID'))->verifications->create($this->phone_number, 'sms');

        return redirect()->route('verify/phone');
    }

    public function markPhoneAsVerified()
    {
        return $this->forceFill([
            'phone_number_verified_at' => $this->freshTimestamp(),
        ])->save();
    }
}
