<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $table = 'tour'; 

    protected $fillable = ['price', 'start', 'end', 'name', 'places', 'description', 'city_id', 'country_id', 'tag_id'];

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

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getIsHotOfferAttribute()
    {
        return $this->start->diffInDays($this->end) <= 3
        || $this->places <= 10;
    }
     public function getFormattedStartAttribute()
    {
        return $this->start ? $this->start->format('Y-m-d') : 'No start date available';
    }

    /**
     * Accessor for formatted end date
     */
    public function getFormattedEndAttribute()
    {
        return $this->end ? $this->end->format('Y-m-d') : 'No start date available';
    }
}
