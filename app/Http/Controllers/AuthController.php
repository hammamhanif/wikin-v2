<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Mews\Captcha\Facades\Captcha;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Notifications\ResetPassword;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        return view('auth.type', compact('user'));
    }
    public function login()
    {
        return view('auth.login');
    }

    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        $callback = Socialite::driver('google')->stateless()->user();
        $data = [
            'name' => $callback->getName(),
            'username' => $callback->getName(),
            'type' => 'masyarakat',
            'email' => $callback->getEmail(),
            'email_verified_at' => now(),
        ];

        $user = User::whereEmail($data['email'])->first();
        if (!$user) {
            $data['password'] = Hash::make('password123');  // Sementara mengatur password default
            $user = User::create($data);

            // Menghasilkan token reset password
            $token = Password::createToken($user);

            // Mengirim notifikasi reset password
            $user->sendPasswordResetNotification($token);
        }

        Auth::login($user, true);
        return redirect(route('type'));
    }


    public function loginPost(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
                'captcha' => 'required|captcha',
            ],
            [
                'captcha' => 'Captcha tidak sesuai, silahkan ulang kembali.',
            ]
        );

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember'); // Mendapatkan nilai remember dari input form

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            // Regenerasi sesi
            $request->session()->regenerate();

            if ($user->type == 'admin') {
                return redirect()->route('dashboard')->withSuccess("Selamat Datang di Dashboard Admin");
            } else if ($user->type == 'user') {
                return redirect()->back()->withSuccess("Selamat Datang di Wikin Dashboard ");
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
            'type' => 'required|in:dosen,mahasiswa,masyarakat'
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
            'type.required' => 'Peran wajib dipilih.',
            'type.in' => 'Pilih salah satu peran yang tersedia (dosen, mahasiswa, masyarakat).'
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'type' => $request->input('type'),
            'password' => Hash::make($request->input('password')),

        ]);
        // dd($request->all());

        event(new Registered($user));
        Auth::login($user, $request->get('remember'));

        return redirect('/email/verify');
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
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'type' => 'required|in:admin,dosen,mahasiswa,masyarakat', // Validate type
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update type field
        if ($request->filled('type')) {
            $user->type = $request->type;
        }

        $user->save();

        return redirect()->route('dashboard')->withSuccess("Selamat Datang di Dashboard Wikin.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
    public function getCaptcha()
    {
        return Captcha::create();
    }
}
