<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\SocialAuth;
use App\User;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $oauthUser = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect('/login');
        }


        $oauthUser = $this->findOrCreateUser($oauthUser, $provider);

        Auth::login($oauthUser, true);

        return redirect($this->redirectTo);
    }

    public function findOrCreateUser($oauthUser, $provider)
    {
        $existingOAuth = SocialAuth::where('provider_name', $provider)
            ->where('provider_id', $oauthUser->getId())
            ->first();

        if ($existingOAuth) {
            return $existingOAuth->user;
        } else {
            $user = User::whereEmail($oauthUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'email' => $oauthUser->getEmail(),
                    'name' => $oauthUser->getName(),
                ]);
            }

            $user->oauth()->create([
                'provider_id' => $oauthUser->getId(),
                'provider_name' => $provider,
            ]);

            return $user;
        }
    }
}
