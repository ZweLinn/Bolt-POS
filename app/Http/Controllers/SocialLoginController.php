<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Socialite;

class SocialLoginController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider)
    {
        $user = Socialite::driver($provider)->user();
        
        $user = User::updateOrCreate([
        'provider_id' => $user->id,
    ], [
        'name' => $user->name,
        'username' => $user->nickname,
        'email' => $user->email,
        'provider' => $provider,
        'provider_token' => $user->token,
        'profile' => $user->avatar,
    ]);
 
    Auth::login($user);
    return redirect()->intended('/user/home');

    }
}
