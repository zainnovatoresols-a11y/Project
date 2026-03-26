<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {

            $user = Auth::guard('web')->user();

            Auth::guard('web')->logout();

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

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        Auth::guard('user')->logout();

        return redirect('/login');
    }
}
