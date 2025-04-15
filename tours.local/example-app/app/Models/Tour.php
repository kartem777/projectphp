<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = ['price', 'start', 'end', 'name', 'description', 'city_id', 'country_id'];

    protected $casts = [
        'start' => 'date',
        'end' => 'date',
    ];

    protected $appends = ['is_hot_offer'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getIsHotOfferAttribute()
    {
        return $this->start->diffInDays($this->end) <= 3;
    }
}
