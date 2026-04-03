<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserService
{
    /**
     * Create a new class instance.
     */
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function getAllUsers()
    {
        return $this->userRepository->getAll();
    }


    public function createUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);

        return $this->userRepository->create($data);
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
