<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function allposts(){
        $posts = Post::all();
        return view('posts', compact('posts'));
    }

    public function createposts(){
        return view('createposts');
    }
}
