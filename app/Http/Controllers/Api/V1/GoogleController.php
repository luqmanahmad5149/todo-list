<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect to Google Oauth login page.
     * @method GET
     * @route /auth/google
     */
    public function googleAuth() {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle login via Google callback.
     * @method GET
     * @route /auth/google/callback
     */
    public function googleAuthCallback() {
        try {
            $user = Socialite::driver('google')->user();
            $findUser = User::where('google_id', $user->id)->first();

            if($findUser) {
                Auth::login($findUser);
                return redirect()->intended('dashboard');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => Hash::make('password'),
                ]);

                Auth::login($newUser);
                return redirect()->intended('dashboard');
            }
        } catch(\Exception $e) {
            throw new GeneralException($e->getMessage(), 400);
        }
    }
}
