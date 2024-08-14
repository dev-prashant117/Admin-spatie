<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginPage()
    {
        return view('admin.auth.login');
    }
    public function login(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Attempt to log the user in
    if (Auth::attempt($request->only('email', 'password'))) {
        // Authentication passed
        $user = Auth::user(); // Retrieve the authenticated user

        // Check if the user has the 'admin' role
        if ($user->hasRole('Admin')) {
            return redirect()->route('admin.dashboard');
        }

        // If the user does not have the 'admin' role, log them out
        Auth::logout(); 

        return redirect()->back()->withErrors([
            'email' => 'You do not have access to the admin area!',
        ]);          
    } else {
        // Authentication failed
        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}

}
