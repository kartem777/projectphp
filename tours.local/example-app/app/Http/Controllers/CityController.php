<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    // Display all cities
    public function index()
    {
        $cities = City::all();
        return view('admin.cities.index', compact('cities'));
    }

    // Show the form to create a new city
    public function create()
    {
        return view('admin.cities.create');
    }

    // Store a newly created city
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:city,name',
        ]);

        City::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.cities.index')->with('success', 'City created successfully!');
    }

    // Show the form to edit an existing city
    public function edit($id)
    {
        $city = City::findOrFail($id);
        return view('admin.cities.edit', compact('city'));
    }

    // Update an existing city
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:city,name,' . $id,
        ]);

        $city = City::findOrFail($id);
        $city->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.cities.index')->with('success', 'City updated successfully!');
    }

    // Delete a city
    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();

        return redirect()->route('admin.cities.index')->with('success', 'City deleted successfully!');
    }

    // Show details of a single city
    public function show($id)
    {
        $city = City::with('tours')->findOrFail($id);
        return view('admin.cities.show', compact('city'));
    }
}
