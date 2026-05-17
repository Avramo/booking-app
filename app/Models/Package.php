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
          'duration_days',
          'is_active',
      ];

      public function bookings()
      {
          return $this->hasMany(Booking::class); 
      }
  }
