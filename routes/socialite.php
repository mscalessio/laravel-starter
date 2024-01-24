<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/apple/redirect', function () {
    return Socialite::driver('apple')->redirect();
})->name('apple.redirect');

Route::get('/github/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('github.redirect');

Route::get('/google/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('google.redirect');

Route::get('/{provider}/callback', function (string $provider) {
    $ssoUser = Socialite::driver($provider)->user();

    if ($user = User::where('email', $ssoUser->email)->first()) {
        $user->update([
            "{$provider}_id" => $ssoUser->id,
            "{$provider}_token" => $ssoUser->token,
            "{$provider}_refresh_token" => $ssoUser->refreshToken,
        ]);
    } else {
        $user = User::updateOrCreate([
            "{$provider}_id" => $ssoUser->id,
        ], [
            'name' => $ssoUser->name,
            'email' => $ssoUser->email,
            'email_verified_at' => now(),
            "{$provider}_token" => $ssoUser->token,
            "{$provider}_refresh_token" => $ssoUser->refreshToken,
        ]);
    }

    Auth::login($user);

    return redirect(config('app.frontend_url') . RouteServiceProvider::HOME);
})
    ->name('auth.callback');
