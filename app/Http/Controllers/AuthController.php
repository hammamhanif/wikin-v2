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
                return redirect()->route('dashboard')->withSuccess("Selamat Datang di Dashboard Admin");
            } else if ($user->type == 'user') {
                return redirect()->route('dashboard')->withSuccess("Selamat Datang di Dashboard Admin");
            } else {
                return redirect()->route('login')->withUnsuccess("Akun anda di nonaktifkan oleh admin, silahkan hubungi admin");
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
            'username.required' => 'Nama pengguna wajib diisi.',
            'username.unique' => 'Nama pengguna sudah digunakan.',
            'username.min' => 'Nama pengguna harus minimal 5 karakter.',
            'username.max' => 'Nama pengguna tidak boleh melebihi 20 karakter.',
            'username.alpha_dash' => 'Nama pengguna hanya boleh mengandung huruf, angka, tanda hubung, dan garis bawah.',
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.min' => 'Nama lengkap harus minimal 5 karakter.',
            'name.max' => 'Nama lengkap tidak boleh melebihi 50 karakter.',
            'name.regex' => 'Nama lengkap hanya boleh mengandung huruf dan spasi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Harap masukkan alamat email yang valid.',
            'email.max' => 'Email tidak boleh melebihi 50 karakter.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi harus minimal 8 karakter.',
            'password.max' => 'Kata sandi tidak boleh melebihi 20 karakter.',
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
