<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Tour;
use App\Models\Feedback;
class AdminController extends Controller
{
     public function index()
    {
        $userCount = User::count() ?? 0;
        $postCount = Post::count() ?? 0;
        $tourCount = Tour::count() ?? 0;
        $feedbackCount = Feedback::count() ?? 0;

        return view('admin.dashboard', compact('tourCount', 'userCount', 'postCount', 'feedbackCount'));
    }
}
