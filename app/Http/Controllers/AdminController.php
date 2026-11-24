<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\ThankYou;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        // 1. Users list with filters
        $usersQuery = User::query()->where('role', '!=', 'admin');

        if ($request->filled('status')) {
            $usersQuery->where('status', $request->status);
        }

        if ($request->filled('role')) {
            $usersQuery->where('role', $request->role);
        }

        $users = $usersQuery->latest()->paginate(10, ['*'], 'users_page')->withQueryString();

        // 2. Pantau Donasi (Audit Log / All Donations)
        $donations = Donation::with(['donor', 'claimedBy'])
            ->latest()
            ->paginate(10, ['*'], 'donations_page')
            ->withQueryString();

        // 3. Thank You Feedbacks
        $thankYous = ThankYou::with(['donation', 'sender', 'donor'])->latest()->take(10)->get();

        // 4. Metrics
        $metrics = [
            'total_users' => User::where('role', '!=', 'admin')->count(),
            'pending_users' => User::where('status', 'pending')->count(),
            'verified_users' => User::where('status', 'verified')->count(),
            'total_donations' => Donation::count(),
            'claimed_donations' => Donation::where('status', 'claimed')->orWhereNotNull('claimed_by_user_id')->count(),
            'expired_donations' => Donation::where('status', 'expired')->orWhere('deadline', '<=', now())->count(),
            'thank_yous_count' => ThankYou::count(),
        ];

        return view('admin.dashboard', compact('users', 'donations', 'thankYous', 'metrics'));
    }

    public function verifyUser(User $user)
    {
        $user->update(['status' => 'verified']);
        return back()->with('success', "Akun {$user->institution_name} ({$user->name}) berhasil diverifikasi.");
    }

    public function rejectUser(User $user)
    {
        $user->update(['status' => 'rejected']);
        return back()->with('success', "Akun {$user->institution_name} ({$user->name}) telah ditolak.");
    }

    public function suspendUser(User $user)
    {
        $user->update(['status' => 'pending']);
        return back()->with('success', "Akun {$user->institution_name} ({$user->name}) dikembalikan ke status Menunggu Verifikasi.");
    }
}
