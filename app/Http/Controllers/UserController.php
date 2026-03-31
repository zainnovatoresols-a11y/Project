<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Services\UserService;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    function create()
    {
        return view('users.create');
    }

    public function store(StoreUserRequest $request, UserService $userService)
    {
        $validated = $request->validated();
        $userService->createUser($validated);

        return redirect()->route('login')->with('success', 'User added successfully!');
    }
}
