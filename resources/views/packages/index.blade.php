<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Israel Vacation Packages</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-5xl mx-auto px-4 py-12">
        <div class="mb-8">
            <img src="{{ asset('images/potash-logo.png') }}" alt="First Class Potash Logo" class="h-40 rounded-full">
        </div>
        <h1 class="text-3xl font-bold text-gray-900 mb-2">First Class Potash - Israel Vacation Packages</h1>
        <p class="text-gray-500 mb-10">Curated trips, fully arranged for you.</p>

        @if($packages->isEmpty())
            <p class="text-gray-400">No packages available yet.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($packages as $package)
                    <a href="{{ route('packages.show', $package->slug) }}"
                       class="block bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
                        <h2 class="text-lg font-semibold text-gray-900 mb-1">{{ $package->name }}</h2>
                        <p class="text-sm text-gray-600 line-clamp-3">{{ $package->description }}</p>
                        <span class="mt-4 inline-block text-sm font-medium text-blue-600">View package →</span>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
