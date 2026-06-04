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

        <p class="text-gray-700 leading-relaxed mb-8">{{ $package->description }}</p>

        @if($package->services->isNotEmpty())
            <div class="mb-10">
                <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-6">What's included</h2>

                <div class="space-y-4">
                    @foreach($package->services as $service)
                        <div class="bg-white border border-gray-100 rounded-xl p-5 flex items-start justify-between gap-4 shadow-sm">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-xs font-medium text-blue-600 uppercase tracking-wide">{{ $service->category->label() }}</span>
                                    @if($service->tier)
                                        <span class="text-xs text-gray-400 border border-gray-200 rounded px-1.5 py-0.5">{{ $service->tier }}</span>
                                    @endif
                                </div>
                                <h3 class="text-base font-semibold text-gray-900">{{ $service->name }}</h3>
                                @if($service->description)
                                    <p class="text-sm text-gray-500 mt-1">{{ $service->description }}</p>
                                @endif
                            </div>
                            <div class="text-right shrink-0">
                                <span class="text-base font-semibold text-gray-900">${{ number_format($service->price, 2) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                @php
                    $servicesTotal = $package->services->sum('price');
                    $grandTotal = $servicesTotal + $package->concierge_fee;
                @endphp
                <div class="mt-6 flex justify-end">
                    <div class="bg-white border border-gray-100 rounded-xl shadow-sm px-6 py-4 text-right min-w-64 space-y-2">
                        <div class="flex justify-between gap-8 text-sm text-gray-600">
                            <span>Services</span>
                            <span>${{ number_format($servicesTotal, 2) }}</span>
                        </div>
                        @if($package->concierge_fee > 0)
                            <div class="flex justify-between gap-8 text-sm text-gray-600">
                                <span>Concierge fee</span>
                                <span>${{ number_format($package->concierge_fee, 2) }}</span>
                            </div>
                        @endif
                        <div class="border-t border-gray-100 pt-2 flex justify-between gap-8">
                            <span class="text-sm font-semibold text-gray-800">Total</span>
                            <span class="text-xl font-bold text-blue-600">${{ number_format($grandTotal, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif

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
