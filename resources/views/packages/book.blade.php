<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book {{ $package->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-2xl mx-auto px-4 py-12">
        <a href="{{ route('packages.show', $package->slug) }}"
           class="text-sm text-blue-600 hover:underline mb-6 inline-block">← Back to {{ $package->name }}</a>

        <h1 class="text-2xl font-bold text-gray-900 mb-1">Book: {{ $package->name }}</h1>
        <p class="text-sm text-gray-400 mb-8">Fill in your details below and we'll be in touch within 24 hours.</p>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">
                <ul class="text-sm text-red-600 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('packages.book.store', $package->slug) }}" class="space-y-8">
            @csrf

            {{-- Personal info --}}
            <div>
                <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">Personal Information</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Client 1 Name <span class="text-red-500">*</span></label>
                        <input type="text" name="client1_name" value="{{ old('client1_name') }}"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="First name (father / primary contact)" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Client 2 Name</label>
                        <input type="text" name="client2_name" value="{{ old('client2_name') }}"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="First name (mother / second contact)">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Family Name</label>
                        <input type="text" name="family_name" value="{{ old('family_name') }}"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Last name">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="your@email.com" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mobile 1 <span class="text-red-500">*</span></label>
                        <input type="tel" name="phone_mobile1" value="{{ old('phone_mobile1') }}"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="+1 212 555 0100" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mobile 2</label>
                        <input type="tel" name="phone_mobile2" value="{{ old('phone_mobile2') }}"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="+1 212 555 0101">
                    </div>
                </div>
            </div>

            {{-- Trip details --}}
            <div>
                <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">Trip Details</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Arrival Date <span class="text-red-500">*</span></label>
                        <input type="date" name="start_date" value="{{ old('start_date') }}"
                               min="{{ date('Y-m-d') }}"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Return Date <span class="text-red-500">*</span></label>
                        <input type="date" name="end_date" value="{{ old('end_date') }}"
                               min="{{ date('Y-m-d') }}"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Adults <span class="text-red-500">*</span></label>
                        <input type="number" name="adults_count" value="{{ old('adults_count', 2) }}" min="1" max="100"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Children <span class="text-red-500">*</span></label>
                        <input type="number" name="children_count" value="{{ old('children_count', 0) }}" min="0" max="100"
                               class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                </div>
            </div>

            {{-- Preferences --}}
            <div>
                <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">Preferences</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Language</label>
                        <select name="language"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">— Select —</option>
                            <option value="english_yiddish" @selected(old('language') === 'english_yiddish')>English & Yiddish</option>
                            <option value="english_hebrew" @selected(old('language') === 'english_hebrew')>English & Hebrew</option>
                            <option value="english" @selected(old('language') === 'english')>English only</option>
                            <option value="all" @selected(old('language') === 'all')>All languages</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Community</label>
                        <select name="sector"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">— Select —</option>
                            <option value="hasidic" @selected(old('sector') === 'hasidic')>Hasidic</option>
                            <option value="litvish" @selected(old('sector') === 'litvish')>Litvish</option>
                            <option value="modern_american" @selected(old('sector') === 'modern_american')>Modern American</option>
                            <option value="frummers" @selected(old('sector') === 'frummers')>Frummers</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kashrut</label>
                        <select name="kashrut"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">— Select —</option>
                            <option value="all" @selected(old('kashrut') === 'all')>All kosher</option>
                            <option value="mehadrin" @selected(old('kashrut') === 'mehadrin')>Mehadrin only</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Trip Purpose</label>
                        <select name="trip_purpose"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">— Select —</option>
                            <option value="trip" @selected(old('trip_purpose') === 'trip')>Vacation / Tourism</option>
                            <option value="business" @selected(old('trip_purpose') === 'business')>Business</option>
                            <option value="family_event" @selected(old('trip_purpose') === 'family_event')>Family event (Bar Mitzvah, Chalaka...)</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Payment method --}}
            <div>
                <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">Preferred Payment Method <span class="text-red-500">*</span></h2>
                <div class="flex flex-wrap gap-4">
                    @foreach(['quickpay' => 'QuickPay', 'credit' => 'Credit Card', 'cash' => 'Cash', 'check' => 'Check', 'transfer' => 'Bank Transfer'] as $value => $label)
                        <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                            <input type="radio" name="payment_method" value="{{ $value }}"
                                   @checked(old('payment_method') === $value)
                                   class="accent-blue-600">
                            {{ $label }}
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Notes --}}
            <div>
                <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">Notes & Special Requests</h2>
                <textarea name="notes" rows="4"
                          class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                          placeholder="Anything else we should know about your trip...">{{ old('notes') }}</textarea>
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white font-semibold px-6 py-3 rounded-xl hover:bg-blue-700 transition text-sm">
                Submit Booking Request
            </button>

            <p class="text-xs text-gray-400 text-center">
                After submitting, we'll send a confirmation link to your email to verify your request.
            </p>
        </form>
    </div>
</body>
</html>
