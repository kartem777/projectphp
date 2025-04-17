<?php
// app/Models/Tag.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tag'; 

    protected $fillable = ['name'];

    public function tours() {
        return $this->hasMany(Tour::class);
    }
}
