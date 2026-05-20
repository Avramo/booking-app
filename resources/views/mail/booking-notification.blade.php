<x-mail::message>
# New confirmed booking

**Package:** {{ $booking->package->name }}

---

**Customer**
- Name: {{ $booking->client1_name }}{{ $booking->client2_name ? ' & ' . $booking->client2_name : '' }}{{ $booking->family_name ? ' (' . $booking->family_name . ')' : '' }}
- Email: {{ $booking->email }}
- Phone 1: {{ $booking->phone_mobile1 }}
@if($booking->phone_mobile2)
- Phone 2: {{ $booking->phone_mobile2 }}
@endif

**Trip**
- Arrival: {{ \Carbon\Carbon::parse($booking->start_date)->format('F j, Y') }}
- Return: {{ \Carbon\Carbon::parse($booking->end_date)->format('F j, Y') }}
- Adults: {{ $booking->adults_count }} | Children: {{ $booking->children_count }}

**Preferences**
- Language: {{ $booking->language ?? '—' }}
- Sector: {{ $booking->sector ?? '—' }}
- Kashrut: {{ $booking->kashrut ?? '—' }}
- Trip purpose: {{ $booking->trip_purpose ?? '—' }}
- Payment method: {{ $booking->payment_method ?? '—' }}

@if($booking->notes)
**Notes:** {{ $booking->notes }}
@endif

---

Booking ID: #{{ $booking->id }}
</x-mail::message>
