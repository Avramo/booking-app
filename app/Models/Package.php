<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
        'concierge_fee',
    ];

    protected $casts = [
        'concierge_fee' => 'decimal:2',
        'is_active'     => 'boolean',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'package_services')
            ->withPivot('sort_order')
            ->orderByPivot('sort_order');
    }
}
