<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    // Display all countries
    public function index()
    {
        $countries = Country::all();
        return view('admin.countries.index', compact('countries'));
    }

    // Show the form to create a new country
    public function create()
    {
        return view('admin.countries.create');
    }

    // Store a newly created country
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:country,name',
        ]);

        Country::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.countries.index')->with('success', 'Country created successfully!');
    }

    // Show the form to edit an existing country
    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return view('admin.countries.edit', compact('country'));
    }

    // Update an existing country
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:country,name,' . $id,
        ]);

        $country = Country::findOrFail($id);
        $country->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.countries.index')->with('success', 'Country updated successfully!');
    }

    // Delete a country
    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();

        return redirect()->route('admin.countries.index')->with('success', 'Country deleted successfully!');
    }

    // Show details of a single country
    public function show($id)
    {
        $country = Country::with('tours')->findOrFail($id);
        return view('admin.countries.show', compact('country'));
    }
}
