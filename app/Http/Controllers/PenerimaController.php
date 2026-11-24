<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\ThankYou;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenerimaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $claimedDonations = Donation::with(['donor', 'thankYou'])
            ->where('claimed_by_user_id', $user->id)
            ->latest('claimed_at')
            ->paginate(10);

        return view('penerima.dashboard', compact('user', 'claimedDonations'));
    }

    public function claim(Donation $donation)
    {
        $user = Auth::user();

        if (!$user || !$user->isPenerima()) {
            return redirect()->route('login')->with('error', 'Hanya akun Penerima terverifikasi yang diperbolehkan mengklaim donasi.');
        }

        if ($user->status !== 'verified') {
            return back()->with('error', 'Akun Anda belum diverifikasi oleh Admin. Anda belum diperbolehkan mengklaim donasi.');
        }

        // Atomic check for double claim and expiry
        return DB::transaction(function () use ($donation, $user) {
            // Lock row for update to prevent race conditions
            $currentDonation = Donation::where('id', $donation->id)->lockForUpdate()->first();

            if (!$currentDonation) {
                return back()->with('error', 'Data donasi tidak ditemukan.');
            }

            if ($currentDonation->claimed_by_user_id || $currentDonation->status === 'claimed') {
                return back()->with('error', 'Maaf! Donasi ini sudah diklaim oleh pihak penerima lain.');
            }

            if ($currentDonation->deadline && now()->greaterThanOrEqualTo($currentDonation->deadline)) {
                $currentDonation->update(['status' => 'expired']);
                return back()->with('error', 'Maaf! Donasi ini telah melewati batas waktu layak konsumsi (Kedaluwarsa).');
            }

            $currentDonation->update([
                'status' => 'claimed',
                'claimed_by_user_id' => $user->id,
                'claimed_at' => now(),
            ]);

            return redirect()->route('penerima.dashboard')->with('success', 'Selamat! Donasi ' . $currentDonation->title . ' berhasil Anda klaim. Silakan hubungi PIC Pendonasi untuk serah terima.');
        });
    }

    public function sendThankYou(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'donation_id' => ['required', 'exists:donations,id'],
            'message' => ['required', 'string', 'min:5'],
        ]);

        $donation = Donation::findOrFail($validated['donation_id']);

        if ($donation->claimed_by_user_id !== $user->id) {
            return back()->with('error', 'Anda hanya dapat mengirim ucapan terima kasih untuk donasi yang Anda klaim.');
        }

        if (ThankYou::where('donation_id', $donation->id)->exists()) {
            return back()->with('error', 'Anda telah mengirim ucapan terima kasih untuk donasi ini.');
        }

        ThankYou::create([
            'donation_id' => $donation->id,
            'sender_id' => $user->id,
            'donor_id' => $donation->user_id,
            'message' => $validated['message'],
        ]);

        return back()->with('success', 'Ucapan terima kasih berhasil dikirimkan kepada Pendonasi!');
    }
}
