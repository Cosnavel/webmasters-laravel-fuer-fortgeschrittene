<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    //
    public function create()
    {
        return view('auth.verify_email');
    }

    public function store(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|digits:6',
        ]);

        return $request->user()->validNotificationToken($request->verification_code) ? redirect()->route('home') : back()->with(['error' =>'invalid code']);
    }
}
