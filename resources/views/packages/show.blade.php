<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $package->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 py-12">
        <a href="{{ route('packages.index') }}" class="text-sm text-blue-600 hover:underline mb-6 inline-block">← All packages</a>

        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $package->name }}</h1>
        <p class="text-sm text-gray-400 mb-6">{{ $package->duration_days }} days</p>

        <p class="text-gray-700 leading-relaxed mb-10">{{ $package->description }}</p>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl px-4 py-3 mb-6">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('packages.book', $package->slug) }}"
           class="inline-block bg-blue-600 text-white font-semibold px-6 py-3 rounded-xl hover:bg-blue-700 transition">
            Book this package
        </a>
    </div>
</body>
</html>
