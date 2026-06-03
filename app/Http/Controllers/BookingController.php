<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create(string $slug)
    {
        $package = Package::where('slug', $slug)->where('is_active', true)->firstOrFail();

        return view('packages.book', compact('package'));
    }

    public function store(Request $request, string $slug)
    {
        $package = Package::where('slug', $slug)->where('is_active', true)->firstOrFail();

        $validated = $request->validate([
            'client1_name'   => 'required|string|max:100',
            'client2_name'   => 'nullable|string|max:100',
            'family_name'    => 'nullable|string|max:100',
            'email'          => 'required|email',
            'phone_mobile1'  => 'required|string|max:30',
            'phone_mobile2'  => 'nullable|string|max:30',
            'start_date'     => 'required|date|after_or_equal:today',
            'end_date'       => 'required|date|after:start_date',
            'adults_count'   => 'required|integer|min:1|max:100',
            'children_count' => 'required|integer|min:0|max:100',
            'language'       => 'nullable|string',
            'sector'         => 'nullable|string',
            'kashrut'        => 'nullable|string',
            'trip_purpose'   => 'nullable|string',
            'payment_method' => 'required|string',
            'notes'          => 'nullable|string|max:2000',
        ]);

        $booking = Booking::create([
            ...$validated,
            'package_id' => $package->id,
            'status'     => 'pending_payment',
        ]);

        // Step 5: redirect to Stripe Checkout here
        return redirect()
            ->route('packages.show', $slug)
            ->with('success', 'Booking received — payment coming soon.');
    }
}
