<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\City;
use App\Models\Country;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'country', 'city', 'tag'])->get();
        return view('post.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::with(['user', 'country', 'city', 'tag'])->findOrFail($id);
        return view('post.show', compact('post'));
    }


    public function create()
    {
        $countries = Country::all();
        $cities = City::all();
        $tags = Tag::all();

        return view('post.create', compact('countries', 'cities', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'city_id' => 'required|exists:city,id',
            'country_id' => 'required|exists:country,id',
            'tag_id' => 'required|exists:tag,id',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'city_id' => $request->city_id,
            'country_id' => $request->country_id,
            'tag_id' => $request->tag_id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('post.index')->with('success', 'Tour updated successfully!');
    }
}
