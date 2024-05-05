<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function showRegistrationForm()
{
    return view('auth.register');
}


public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif',
    ]);

    // Handle the avatar upload
    if ($request->hasFile('avatar')) {
        $avatarPath = $request->file('avatar')->store('avatars', 'public');
    } else {
        $avatarPath = null;
    }


    // Create the user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'avatar' => $avatarPath,
    ]);
    Auth::login($user);

    return redirect('/');
}


    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
{

    $credentials = $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);


    if (Auth::attempt($credentials)) {
        return redirect()->intended('/');
    } else {
        return back()->withInput()->withErrors(['email' => 'Invalid credentials']);
    }
}
public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
}
}
