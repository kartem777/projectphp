<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;

class TourController extends Controller
{
    public function allinfo(){
        $tours = Tour::all();
        return view('tours', compact('tours'));
    }
    public function home(){
        $tours = Tour::orderBy('id', 'desc')->take(3)->get();
        return view('home', compact('tours'));
    }
}
