<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\City;
use App\Models\Country;
use App\Models\Tag;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class TourController extends Controller
{
    public function allinfo(Request $request)
{
    $countries = Country::all();
    $cities = City::all();
    $tags = Tag::all();
    $query = Tour::with(['city', 'country', 'tag', 'images']);

    if ($request->filled('search')) {
        $searchTerm = $request->search;
        $query->where(function($q) use ($searchTerm) {
            $q->where('name', 'like', '%' . $searchTerm . '%')
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

    if ($request->filled('price_min') && $request->filled('price_max')) {
        $query->whereBetween('price', [$request->price_min, $request->price_max]);
    }

    if ($request->filled('tag')) {
        $tag = Tag::where('name', $request->tag)->first();
        if ($tag) $query->where('tag_id', $tag->id);
    }

    $tours = $query->orderByDesc('id')->get();

    if ($request->filled('hot_offer')) {
        $tours = $tours->filter(fn($tour) => $tour->is_hot_offer);
    }

    $tours = $tours->filter(fn($tour) => $tour->places > 0);

    return view('tours', compact('tours', 'countries', 'cities', 'tags'));
}



    public function allinfoadmin()
    {
        $tours = Tour::with(['city', 'country', 'tag', 'images'])->get();
        return view('admin.tours.index', compact('tours'));
    }

    public function home()
    {
        $tours = Tour::with(['city', 'country', 'tag', 'images'])
                     ->orderByDesc('id')
                     ->get();

        $tours = $tours->filter(fn($tour) => $tour->places > 0);

        if ($tours->count() < 3) {
            $additionalTours = Tour::with(['city', 'country', 'tag', 'images'])
                                   ->orderByDesc('id')
                                   ->take(3 - $tours->count())
                                   ->get();

            $additionalTours = $additionalTours->filter(fn($tour) => $tour->places > 0);

            $tours = $tours->merge($additionalTours);
        }

        $tours = $tours->take(3);

        return view('index', compact('tours'));
    }


    public function create()
    {
        $cities = City::all();
        $countries = Country::all();
        $tags = Tag::all();
        return view('admin.tours.create', compact('cities', 'countries', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'price' => 'required|numeric',
            'start' => 'required|date',
            'end' => 'required|date',
            'places' => 'required|integer',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'tag' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:10240'
        ]);

        $city = City::where('name', $request->city)->firstOrFail();
        $country = Country::where('name', $request->country)->firstOrFail();
        $tag = Tag::where('name', $request->tag)->firstOrFail();

        $tour = Tour::create([
            'price' => $request->price,
            'start' => Carbon::parse($request->start)->format('Y-m-d'),
            'end' => Carbon::parse($request->end)->format('Y-m-d'),
            'places' => $request->places,
            'name' => $request->name,
            'description' => $request->description,
            'city_id' => $city->id,
            'country_id' => $country->id,
            'tag_id' => $tag->id,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $uploadedImage) {
                $path = $uploadedImage->store('images', 'public');
                $tour->images()->create([
                    'url' => 'storage/' . $path,
                ]);
            }
        }

        return redirect()->route('admin.tours.index')->with('success', 'Tour created successfully!');
    }

    public function edit($id)
    {
        $tour = Tour::findOrFail($id);
        $cities = City::all();
        $countries = Country::all();
        $tags = Tag::all();
        return view('admin.tours.edit', compact('tour', 'cities', 'countries', 'tags'));
    }

   public function update(Request $request, $id)
{
    $request->validate([
        'price' => 'required|numeric',
        'start' => 'required|date',
        'end' => 'required|date',
        'places' => 'required|integer',
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'city' => 'required|string',
        'country' => 'required|string',
        'tag' => 'required|string',
        'images.*' => 'image|mimes:jpeg,png,jpg|max:10240'
    ]);

    $tour = Tour::findOrFail($id);
    $city = City::where('name', $request->city)->firstOrFail();
    $country = Country::where('name', $request->country)->firstOrFail();
    $tag = Tag::where('name', $request->tag)->firstOrFail();

    $tour->update([
        'price' => $request->price,
        'start' => $request->start,
        'end' => $request->end,
        'places' => $request->places,
        'name' => $request->name,
        'description' => $request->description,
        'city_id' => $city->id,
        'country_id' => $country->id,
        'tag_id' => $tag->id,
    ]);

    if ($request->hasFile('images')) {
        // Remove images that are no longer included in the request
        foreach ($tour->images as $index => $oldImage) {
            if (!in_array($oldImage->url, $request->images ?? [])) {
                // Delete the old image from storage
                Storage::disk('public')->delete(str_replace('storage/', '', $oldImage->url));
                $oldImage->delete();
            }
        }

        // Add new images
        foreach ($request->file('images') as $uploadedImage) {
            $path = $uploadedImage->store('images', 'public');
            $tour->images()->create([
                'url' => 'storage/' . $path,
            ]);
        }
    }

    return redirect()->route('admin.tours.index')->with('success', 'Tour updated successfully!');
}


    public function destroy($id)
    {
        $tour = Tour::findOrFail($id);
        foreach ($tour->images as $image) {
            Storage::disk('public')->delete(str_replace('storage/', '', $image->url));
            $image->delete();
        }
        $tour->delete();

        return redirect()->route('admin.tours.index')->with('success', 'Tour and related images deleted!');
    }

    public function show($id)
    {
        $tour = Tour::with(['city', 'country', 'tag', 'images'])->findOrFail($id);
        return view('admin.tours.show', compact('tour'));
    }

    public function showuser($id)
    {
        $tour = Tour::with(['city', 'country', 'tag', 'images'])->findOrFail($id);
        return view('tourdetails', compact('tour'));
    }


}
