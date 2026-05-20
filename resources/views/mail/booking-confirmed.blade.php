<x-mail::message>
# We've received your booking

Hi {{ $booking->client1_name }},

Your booking request for **{{ $booking->package->name }}** has been received and confirmed.

We'll review the details and be in touch within 24 hours to finalize your trip.

**Summary:**
- Package: {{ $booking->package->name }}
- Arrival: {{ \Carbon\Carbon::parse($booking->start_date)->format('F j, Y') }}
- Return: {{ \Carbon\Carbon::parse($booking->end_date)->format('F j, Y') }}
- Adults: {{ $booking->adults_count }} | Children: {{ $booking->children_count }}
@if($booking->notes)
- Notes: {{ $booking->notes }}
@endif

Thanks for choosing First Class Potash. We look forward to arranging your trip to Israel.

Thanks,
**First Class Potash**
</x-mail::message>
