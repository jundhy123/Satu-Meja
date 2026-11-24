<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PublicDonationController extends Controller
{
    public function index(Request $request)
    {
        // 1. Auto update expired donations
        Donation::where('status', '!=', 'claimed')
            ->where('deadline', '<=', Carbon::now())
            ->update(['status' => 'expired']);

        // 2. Query available active donations
        $query = Donation::with('donor')
            ->whereNull('claimed_by_user_id')
            ->where('status', '!=', 'claimed')
            ->where('status', '!=', 'expired')
            ->where('deadline', '>', Carbon::now());

        if ($request->filled('food_type')) {
            $query->where('food_type', $request->food_type);
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->filled('deadline_filter')) {
            if ($request->deadline_filter === 'today') {
                $query->whereDate('deadline', Carbon::today());
            } elseif ($request->deadline_filter === 'urgent') {
                $query->where('deadline', '<=', Carbon::now()->addHours(48));
            }
        }

        $donations = $query->orderBy('deadline', 'asc')->paginate(12)->withQueryString();

        return view('donations.index', compact('donations'));
    }

    public function activeJson()
    {
        // Auto update expired items
        Donation::where('status', '!=', 'claimed')
            ->where('deadline', '<=', Carbon::now())
            ->update(['status' => 'expired']);

        $activeDonations = Donation::whereNull('claimed_by_user_id')
            ->whereNotIn('status', ['claimed', 'expired'])
            ->where('deadline', '>', Carbon::now())
            ->orderBy('deadline', 'asc')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'food_type' => $item->food_type,
                    'quantity' => $item->quantity,
                    'location' => $item->location,
                    'deadline' => $item->deadline ? $item->deadline->format('Y-m-d H:i:s') : null,
                    'status' => $item->computed_status,
                ];
            });

        return response()->json([
            'status' => 'success',
            'count' => $activeDonations->count(),
            'data' => $activeDonations,
            'timestamp' => now()->toIso8601String(),
        ]);
    }
}
