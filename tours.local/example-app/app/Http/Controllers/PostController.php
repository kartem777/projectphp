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
    public function index(Request $request)
    {
        $countries = Country::all();
        $cities = City::all();
        $tags = Tag::all();
        $query = Post::with(['user', 'country', 'city', 'tag']);

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhereHas('city', fn($q) => $q->where('name', 'like', "%$searchTerm%"))
                  ->orWhereHas('country', fn($q) => $q->where('name', 'like', "%$searchTerm%"))
                  ->orWhereHas('tag', fn($q) => $q->where('name', 'like', "%$searchTerm%"));
            });
        }

        if ($request->filled('country')) {
            $country = Country::where('name', $request->country)->first();
            if ($country) $query->where('country_id', $country->id);
        }

        if ($request->filled('city')) {
            $city = City::where('name', $request->city)->first();
            if ($city) $query->where('city_id', $city->id);
        }

        if ($request->filled('tag')) {
            $tag = Tag::where('name', $request->tag)->first();
            if ($tag) $query->where('tag_id', $tag->id);
        }

        $posts = $query->orderByDesc('id')->get();

        return view('post.index', compact('posts', 'countries', 'cities', 'tags'));
    }

    public function myPost(Request $request)
    {
        $countries = Country::all();
        $cities = City::all();
        $tags = Tag::all();
        $query = Post::with(['user', 'country', 'city', 'tag']);

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                ->orWhereHas('city', fn($q) => $q->where('name', 'like', "%$searchTerm%"))
                ->orWhereHas('country', fn($q) => $q->where('name', 'like', "%$searchTerm%"))
                ->orWhereHas('tag', fn($q) => $q->where('name', 'like', "%$searchTerm%"));
            });
        }

        if ($request->filled('country')) {
            $country = Country::where('name', $request->country)->first();
            if ($country) $query->where('country_id', $country->id);
        }

        if ($request->filled('city')) {
            $city = City::where('name', $request->city)->first();
            if ($city) $query->where('city_id', $city->id);
        }

        if ($request->filled('tag')) {
            $tag = Tag::where('name', $request->tag)->first();
            if ($tag) $query->where('tag_id', $tag->id);
        }

        $query->where('user_id', Auth::id()); // <-- Ось так!

        $posts = $query->orderByDesc('id')->get();

        return view('post.myPosts', compact('posts', 'countries', 'cities', 'tags'));
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

    // Ваш контролер для редагування посту
    public function edit($id)
    {
        $post = Post::findOrFail($id); // Отримуємо пост за ID
        $countries = Country::all();  // Отримуємо всі країни
        $cities = City::all();        // Отримуємо всі міста
        $tags = Tag::all();           // Отримуємо всі теги

        return view('post.edit', compact('post', 'countries', 'cities', 'tags'));
    }

    public function update(Request $request, $id)
    {
        // Знайдемо пост по id
        $post = Post::findOrFail($id);

        // Валідні дані
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'country' => 'required|exists:country,id',
            'city' => 'required|exists:city,id',
            'tag' => 'nullable|exists:tag,id', // Тільки один тег
        ]);

        // Оновлення посту
        $post->title = $validated['title'];
        $post->description = $validated['description'];
        $post->country_id = $validated['country'];
        $post->city_id = $validated['city'];

        // Оновлення одного тегу
        if (isset($validated['tag'])) {
            $post->tag_id = $validated['tag']; // Заміна на tag_id
        }

        // Зберігаємо пост
        $post->save();

        // Перенаправлення на сторінку перегляду посту після оновлення
        return redirect()->route('post.show', $post->id);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('post.myPosts')->with('success', 'Пост успішно видалено!');
    }
}
