<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';

    use HasFactory;

    protected $fillable = ['user_id', 'city_id', 'country_id', 'tag_id', 'title', 'description'];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function tag() {
        return $this->belongsTo(Tag::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }
}
