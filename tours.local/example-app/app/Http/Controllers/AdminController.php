<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Tour;
use App\Models\Feedback;
use App\Models\City;
use App\Models\Country;
use App\Models\Tag;
use App\Models\Booking;
class AdminController extends Controller
{
     public function index()
    {
        $userCount = User::count() ?? 0;
        $postCount = Post::count() ?? 0;
        $tourCount = Tour::count() ?? 0;
        $feedbackCount = Feedback::count() ?? 0;
        $cityCount = City::count() ?? 0;
        $countryCount = Country::count() ?? 0;
        $tagCount = Tag::count() ?? 0;
        $bookingCount = Booking::count() ?? 0;

        return view('admin.dashboard', compact('tourCount', 'userCount', 'postCount', 'feedbackCount', 'cityCount', 'countryCount', 'tagCount', 'bookingCount'));
    }
}
