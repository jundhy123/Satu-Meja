<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\ThankYou;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendonasiController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $donations = Donation::with('claimedBy')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        $thankYous = ThankYou::with(['sender', 'donation'])
            ->where('donor_id', $user->id)
            ->latest()
            ->get();

        return view('pendonasi.dashboard', compact('user', 'donations', 'thankYous'));
    }

    public function create()
    {
        $user = Auth::user();
        if ($user->status !== 'verified') {
            return redirect()->route('pendonasi.dashboard')->with('error', 'Akun Anda belum diverifikasi oleh Admin. Hanya Pendonasi terverifikasi yang diperbolehkan mempublikasikan donasi.');
        }

        return view('pendonasi.create', compact('user'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->status !== 'verified') {
            return redirect()->route('pendonasi.dashboard')->with('error', 'Akun Anda belum diverifikasi oleh Admin. Publikasi donasi ditolak.');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'food_type' => ['required', 'string', 'max:100'],
            'quantity' => ['required', 'string', 'max:255'],
            'delivery_method' => ['required', 'string', 'in:Ambil Sendiri,Diantar Pendonasi'],
            'deadline' => ['required', 'date', 'after:now'],
            'location' => ['required', 'string', 'max:255'],
            'pickup_address' => ['required', 'string'],
            'pic_name' => ['required', 'string', 'max:255'],
            'pic_contact' => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'allergen_notes' => ['nullable', 'string'],
            'storage_notes' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('donations', 'public');
        }

        $deadlineTime = Carbon::parse($validated['deadline']);

        // Determine status based on contract: sisa waktu < 48 jam = urgent; besides = available
        $status = $deadlineTime->diffInHours(now()) <= 48 ? 'urgent' : 'available';

        Donation::create([
            'user_id' => $user->id,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'photo' => $photoPath,
            'food_type' => $validated['food_type'],
            'quantity' => $validated['quantity'],
            'delivery_method' => $validated['delivery_method'],
            'location' => $validated['location'],
            'pickup_address' => $validated['pickup_address'],
            'pic_name' => $validated['pic_name'],
            'pic_contact' => $validated['pic_contact'],
            'deadline' => $deadlineTime,
            'allergen_notes' => $validated['allergen_notes'] ?? null,
            'storage_notes' => $validated['storage_notes'] ?? null,
            'status' => $status,
        ]);

        return redirect()->route('pendonasi.dashboard')->with('success', 'Donasi pangan berlebih berhasil dipublikasikan! Status awal: ' . strtoupper($status));
    }
}
