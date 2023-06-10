<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }

        $existingUser = User::where('google_id', $user->id)->first();

        if ($existingUser){
            Auth::login($existingUser, true);
        }

        else {
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id' => $user->id,
                'password' => bcrypt('12345dummy'),
                'avatar' => 'avatar4.png'
            ]);

            Auth::login($newUser, true);
        }

        return redirect()->to('/');
    }
}
