<?php

namespace App\Http\Middleware;

use Closure;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! $request->user()->hasVerifiedEmail()) {
            $request->user()->sendEmailVerificationToken();
            return redirect()->route('verify/email');
        }
        return $next($request);
    }
}
