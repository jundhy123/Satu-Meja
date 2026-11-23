<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

class PublicDonationController extends Controller
{
    public function index(Request $request)
    {
        $donations = Donation::query()
            ->when($request->food_type, fn($q, $type) => $q->where('food_type', $type))
            ->when($request->location, fn($q, $loc) => $q->where('location', 'like', "%{$loc}%"))
            ->when($request->deadline, fn($q, $date) => $q->where('deadline', '<=', $date))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('donations.index', compact('donations'));
    }
}