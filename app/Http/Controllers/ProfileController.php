<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'             => ['required', 'string', 'max:255'],
            'institution_name' => ['required', 'string', 'max:255'],
            'category'         => ['required', 'string', 'max:255'],
            'pic_name'         => ['required', 'string', 'max:255'],
            'phone'            => ['required', 'string', 'max:50'],
            'address'          => ['required', 'string'],
            'description'      => ['nullable', 'string', 'max:1000'],
        ], [
            'name.required'             => 'Nama akun wajib diisi.',
            'institution_name.required' => 'Nama usaha/lembaga wajib diisi.',
            'category.required'         => 'Kategori wajib dipilih.',
            'pic_name.required'         => 'Nama penanggung jawab (PIC) wajib diisi.',
            'phone.required'            => 'Nomor telepon wajib diisi.',
            'address.required'          => 'Alamat lengkap wajib diisi.',
        ]);

        $user->update($validated);

        return back()->with('success', 'Profil instansi dan data akun berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'confirmed', Password::defaults()],
        ], [
            'current_password.required'         => 'Kata sandi saat ini wajib diisi.',
            'current_password.current_password' => 'Kata sandi saat ini tidak sesuai.',
            'password.required'                 => 'Kata sandi baru wajib diisi.',
            'password.confirmed'                => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Kata sandi berhasil diperbarui.');
    }
}