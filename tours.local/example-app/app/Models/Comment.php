<?php
// app/Models/Comment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'post_id', 'tour_id', 'comment'];

    protected $casts = [
        'post_id' => 'integer',
        'tour_id' => 'integer', // може бути null, якщо ви збережете значення NULL
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function post() {
        return $this->belongsTo(Post::class);
    }

    public function tour() {
        return $this->belongsTo(Tour::class);
    }
}

