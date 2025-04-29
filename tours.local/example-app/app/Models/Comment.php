<?php
// app/Models/Comment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'post_id', 'tour_id', 'comment_id', 'comment'];

    protected $casts = [
        'post_id' => 'integer',
        'tour_id' => 'integer', // може бути null, якщо ви збережете значення NULL
        'comment_id' => 'integer',
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

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'comment_id')->with('replies', 'user');
    }
}

