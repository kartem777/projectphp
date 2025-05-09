<?php
// app/Models/Country.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'country'; 

    protected $fillable = ['name'];

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }
}
