<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function createUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function loginUser(array $credentials, string $ip)
    {
        //login attempts only 5
        if (RateLimiter::tooManyAttempts('login:' . $ip, 5)) {
            abort(429, 'Too many login attempts. Please try again later.');
        }

        if (Auth::guard('web')->attempt($credentials)) {

            $user = Auth::guard('web')->user();

            Auth::guard('web')->logout();

            if ($user->role === 'admin') {
                Auth::guard('admin')->login($user);
                Auth::shouldUse('admin');
                return ['success' => true, 'redirect' => route('admin.dashboard')];
            } else {
                Auth::guard('user')->login($user);
                Auth::shouldUse('user');
                return ['success' => true, 'redirect' => route('user.dashboard')];
            }
        }

        //Apply time after login attempt exceeds
        RateLimiter::hit('login:' . $ip, 60);

        return ['success' => false];
    }
}
