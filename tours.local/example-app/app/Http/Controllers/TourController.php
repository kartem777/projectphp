<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\City;
use App\Models\Country;
use App\Models\Tag;

class TourController extends Controller
{
    // Display all tours with related city, country, and tag
   public function allinfo(Request $request)
{
    $countries = Country::all();
    $cities = City::all();
    $tags = Tag::all();
    $query = Tour::with(['city', 'country', 'tag']);

    // Apply search filter if provided
    if ($request->filled('search')) {
        $searchTerm = $request->search;
        
        $query->where(function($q) use ($searchTerm) {
            $q->where('name', 'like', '%' . $searchTerm . '%')
                ->orWhereHas('city', function($q) use ($searchTerm) {
                    $q->where('name', 'like', '%' . $searchTerm . '%');
                })
                ->orWhereHas('country', function($q) use ($searchTerm) {
                    $q->where('name', 'like', '%' . $searchTerm . '%');
                })
                ->orWhereHas('tag', function($q) use ($searchTerm) {
                    $q->where('name', 'like', '%' . $searchTerm . '%');
                });
        });
    }

    // Apply filter by country
    if ($request->filled('country')) {
        $country = Country::where('name', $request->country)->first();
        if ($country) {
            $query->where('country_id', $country->id);
        }
    }

    // Apply filter by city
    if ($request->filled('city')) {
        $city = City::where('name', $request->city)->first();
        if ($city) {
            $query->where('city_id', $city->id);
        }
    }

    // Apply filter by price range
    if ($request->filled('price_min') && $request->filled('price_max')) {
        $query->whereBetween('price', [$request->price_min, $request->price_max]);
    }

    // Apply filter by tag
    if ($request->filled('tag')) {
        $tag = Tag::where('name', $request->tag)->first();
        if ($tag) {
            $query->where('tag_id', $tag->id);
        }
    }
    // Fetch the filtered results
    $tours = $query->orderBy('id', 'desc')->get();

    if ($request->filled('hot_offer')) {
        $tours = $tours->filter(function ($tour) {
            return $tour->is_hot_offer; // This will call the `getIsHotOfferAttribute` function
        });
    }

    return view('tours', compact('tours', 'countries', 'cities', 'tags'));
}


    // Display all tours for admin with related city, country, and tag
    public function allinfoadmin()
    {
        $tours = Tour::with(['city', 'country', 'tag'])->get();
        return view('admin.tours.index', compact('tours'));
    }

    // Display the latest 3 tours on the homepage
    public function home()
    {
        $tours = Tour::with(['city', 'country', 'tag'])
            ->orderBy('id', 'desc')
            ->take(3)
            ->get();
        return view('index', compact('tours'));
    }

    // Show the form to create a new tour
    public function create()
    {
        // Fetch cities, countries, and tags to populate the select fields
        $cities = City::all();
        $countries = Country::all();
        $tags = Tag::all();
        
        return view('admin.tours.create', compact('cities', 'countries', 'tags'));
    }

    // Store a newly created tour
    public function store(Request $request)
    {
        // Validate the incoming data
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
        ]);

        // Retrieve city, country, and tag by name
        $city = City::where('name', $request->city)->first();
        $country = Country::where('name', $request->country)->first();
        $tag = Tag::where('name', $request->tag)->first();

        // If any of the entities are not found, redirect back with error
        if (!$city || !$country || !$tag) {
            return redirect()->back()->withErrors('City, Country, or Tag not found!');
        }

        $start = Carbon::parse($request->start)->format('Y-m-d');
        $end = Carbon::parse($request->end)->format('Y-m-d');

        // Create the tour with the validated data
        Tour::create([
            'price' => $request->price,
            'start' => $start,
            'end' => $end,
            'places' => $request->places,
            'name' => $request->name,
            'description' => $request->description,
            'city_id' => $city->id,
            'country_id' => $country->id,
            'tag_id' => $tag->id,
        ]);

        // Redirect with success message
        return redirect()->route('admin.tours.index')->with('success', 'Tour created successfully!');
    }

    // Show the form to edit an existing tour
    public function edit($id)
    {
        $tour = Tour::findOrFail($id); // Fetch the tour by its ID
        $cities = City::all();
        $countries = Country::all();
        $tags = Tag::all();
        
        // Pass the tour and other data to the view
        return view('admin.tours.edit', compact('tour', 'cities', 'countries', 'tags'));
    }

    // Update an existing tour
    public function update(Request $request, $id)
    {
        // Validate the incoming data
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
        ]);

        // Retrieve city, country, and tag by name
        $city = City::where('name', $request->city)->first();
        $country = Country::where('name', $request->country)->first();
        $tag = Tag::where('name', $request->tag)->first();

        // If any of the entities are not found, redirect back with error
        if (!$city || !$country || !$tag) {
            return redirect()->back()->withErrors('City, Country, or Tag not found!');
        }

        // Find the tour by ID and update it with the new data
        $tour = Tour::findOrFail($id);
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

        // Redirect with success message
        return redirect()->route('admin.tours.index')->with('success', 'Tour updated successfully!');
    }

    // Delete a tour
    public function destroy($id)
    {
        $tour = Tour::findOrFail($id);
        $tour->delete();
        
        // Redirect with success message
        return redirect()->route('admin.tours.index')->with('success', 'Tour deleted successfully!');
    }

    // Show the details of a tour
    public function show($id)
    {
        $tour = Tour::with(['city', 'country', 'tag'])->findOrFail($id);
        
        return view('admin.tours.show', compact('tour'));
    }
}
