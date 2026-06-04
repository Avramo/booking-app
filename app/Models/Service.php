<?php

namespace App\Models;

use App\Enums\ServiceCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'category',
        'tier',
        'price',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'category'  => ServiceCategory::class,
        'price'     => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'package_services')
            ->withPivot('sort_order')
            ->orderByPivot('sort_order');
    }
}
