<?php

namespace App\Models;
                                                                            
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'start_date',
        'end_date',
        'status',
        'notes',
        'client1_name',
        'client2_name',
        'family_name',
        'email',
        'phone_mobile1',
        'phone_mobile2',
        'adults_count',
        'children_count',
        'language',
        'sector',
        'kashrut',
        'trip_purpose',
        'payment_method',
        'details',
    ];

    protected $casts = [
        'details' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
