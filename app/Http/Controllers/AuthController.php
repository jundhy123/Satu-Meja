<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return $this->redirectUserBasedOnRole(Auth::user());
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->status === 'rejected') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->withErrors([
                    'email' => 'Akun Anda telah ditolak oleh Admin. Silakan hubungi tim pengelola.',
                ])->onlyInput('email');
            }

            return $this->redirectUserBasedOnRole($user);
        }

        return back()->withErrors([
            'email' => 'Email atau kata sandi yang Anda masukkan tidak sesuai.',
        ])->onlyInput('email');
    }

    public function showRegisterForm()
    {
        if (Auth::check()) {
            return $this->redirectUserBasedOnRole(Auth::user());
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'role' => ['required', 'in:pendonasi,penerima'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'institution_name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'pic_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'address' => ['required', 'string'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $user = User::create([
            'role' => $validated['role'],
            'status' => 'pending',
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'institution_name' => $validated['institution_name'],
            'category' => $validated['category'],
            'pic_name' => $validated['pic_name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'description' => $validated['description'] ?? null,
        ]);

        Auth::login($user);

        return $this->redirectUserBasedOnRole($user)->with('warning', 'Pendaftaran berhasil! Akun Anda saat ini berstatus Menunggu Verifikasi oleh Admin. Anda belum dapat mempublikasikan atau mengklaim donasi sampai Admin memverifikasi akun Anda.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Anda telah keluar dari akun.');
    }

    protected function redirectUserBasedOnRole(User $user)
    {
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isPendonasi()) {
            return redirect()->route('pendonasi.dashboard');
        } else {
            return redirect()->route('penerima.dashboard');
        }
    }
}
