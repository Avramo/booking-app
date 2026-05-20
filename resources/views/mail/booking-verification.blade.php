<x-mail::message>
# Confirm your booking request

Hi {{ $booking->client1_name }},

Thank you for your interest in the **{{ $booking->package->name }}** package.

To submit your booking request, please confirm your details by clicking below.

<x-mail::button :url="$confirmUrl">
Confirm Booking Request
</x-mail::button>

**Your trip details:**
- Arrival: {{ \Carbon\Carbon::parse($booking->start_date)->format('F j, Y') }}
- Return: {{ \Carbon\Carbon::parse($booking->end_date)->format('F j, Y') }}
- Adults: {{ $booking->adults_count }} | Children: {{ $booking->children_count }}

If you did not submit this request, you can safely ignore this email.

Thanks,
**First Class Potash**
</x-mail::message>
