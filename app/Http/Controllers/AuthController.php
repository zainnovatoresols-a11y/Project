<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'email'    => ['required', 'email:rfc', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:72'],
        ]);

        //login attempts only 5
        RateLimiter::tooManyAttempts('login:' . $request->ip(), 5)
            ? abort(429, 'Too many login attempts. Please try again later.')
            : null;


        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {

            $user = Auth::guard('web')->user();

            Auth::guard('web')->logout();

            //use guard according to login user(admin or user);
            if ($user->role === 'admin') {

                Auth::guard('admin')->login($user);
                Auth::shouldUse('admin');

                return redirect()->route('admin.dashboard');
            } else {

                Auth::guard('user')->login($user);
                Auth::shouldUse('user');

                return redirect()->route('user.dashboard');
            }
        }

        //apply time after login atempt exceed
        RateLimiter::hit('login:' . $request->ip(), 60);

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        Auth::guard('user')->logout();

        return redirect('/login');
    }
}
