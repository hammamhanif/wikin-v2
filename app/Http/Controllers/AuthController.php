<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view('auth.login');
    }

    // login post

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember'); // Mendapatkan nilai remember dari input form

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            // Regenerasi sesi
            $request->session()->regenerate();

            if ($user->type == 'admin') {
                return redirect()->route('dashboard')->withSuccess("Welcome to Admin Dashboard");
            } else if ($user->type == 'user') {
                return redirect()->route('dashboard')->withSuccess("Welcome to User Dashboard");
            } else {
                return redirect()->route('login')->withUnsuccess("Your account is not active.");
            }
        }

        return redirect()->route('login')->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }


    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users|min:5|max:20|alpha_dash',
            'name' => 'required|min:5|max:50|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|unique:users|max:50',
            'password' => 'required|min:8|max:20',
        ], [
            'username.required' => 'Username is required.',
            'username.unique' => 'Username is already taken.',
            'username.min' => 'Username must be at least 5 characters.',
            'username.max' => 'Username cannot exceed 20 characters.',
            'username.alpha_dash' => 'Username can only contain letters, numbers, dashes, and underscores.',
            'name.required' => 'Name is required.',
            'name.min' => 'Name must be at least 5 characters.',
            'name.max' => 'Name cannot exceed 50 characters.',
            'name.regex' => 'Name can only contain letters and spaces.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Email cannot exceed 50 characters.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.max' => 'Password cannot exceed 20 characters.',
        ]);

        $user = new User();
        $user->username = $request->input('username');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->route('login')->withSuccess('Akun berhasil dibuat. Silahkan login.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
