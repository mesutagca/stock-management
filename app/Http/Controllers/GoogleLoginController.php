<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\GoogleProvider;
use Symfony\Component\HttpFoundation\RedirectResponse;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle(): RedirectResponse|\Illuminate\Http\RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(UserService $userService): \Illuminate\Http\RedirectResponse
    {
        /** @var GoogleProvider $driver */
        $driver=Socialite::driver('google');
        $googleUser=$driver->stateless()->user();
        $userService->findOrCreateUserByGoogle($googleUser);

        return redirect()->route('dashboard');
    }
}
