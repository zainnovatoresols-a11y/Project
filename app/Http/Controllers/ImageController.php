<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image'
        ]);

        $path = $request->file('image')->store('images', 'public');

       
        $user = Auth::guard('admin')->user() ?? Auth::guard('user')->user();

        if (!$user) {
            return back()->with('error', 'User not logged in');
        }

       
        optional($user->image)->delete();

        $user->image()->create([
            'path' => $path
        ]);

        
        return redirect()->route('user.dashboard')
            ->with('success', 'Post deleted successfully');
    }
}
