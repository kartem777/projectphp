<?php
// app/Models/Tour.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'price', 'start_date', 'end_date', 'places', 'title', 'description', 'city', 'country'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    protected $appends = ['is_hot_offer'];

    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getIsHotOfferAttribute() {
        return $this->places < 5 && $this->start_date->diffInDays($this->end_date) <= 3;
    }
}
