<?php

namespace App\Http\Controllers;

use App\Models\Package;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::where('is_active', true)->get();
        return view('packages.index', compact('packages'));
    }

    public function show(string $slug)
    {
        $package = Package::with(['services' => fn ($q) => $q->where('is_active', true)])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        return view('packages.show', compact('package'));
    }
}
