<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Services\UserService;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request , UserService $userService)
    {
        $request->validate([
            'email'    => ['required', 'email:rfc', 'max:255'],
            'password' => ['required', 'string', 'max:72'],
        ]);

        $credentials = $request->only('email', 'password');
        $ip = $request->ip();
        // dd($ip);

        $result = $userService->loginUser($credentials, $ip);

        if ($result['success']) {
            return redirect($result['redirect']);
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
