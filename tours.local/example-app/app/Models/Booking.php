<?php
// app/Models/Booking.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'tour_id', 'adults_count', 'children_count'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tour() {
        return $this->belongsTo(Tour::class);
    }
}
