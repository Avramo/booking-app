<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmed — First Class Potash</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-md mx-auto px-6 py-16 text-center">
        <div class="text-5xl mb-6">✓</div>
        <h1 class="text-2xl font-bold text-gray-900 mb-3">Booking request confirmed</h1>
        <p class="text-gray-500 mb-2">
            Thank you, {{ $booking->client1_name }}. Your booking request for
            <strong>{{ $booking->package->name }}</strong> has been received.
        </p>
        <p class="text-gray-500 mb-8">
            We'll be in touch within 24 hours to go over the details of your trip.
        </p>
        <a href="{{ route('packages.index') }}"
           class="text-sm text-blue-600 hover:underline">← Back to all packages</a>
    </div>
</body>
</html>
