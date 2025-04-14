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
    public function allinfoadmin(){
        $tours = Tour::all();
        return view('admin.tours.index', compact('tours'));
    }
    public function home(){
        $tours = Tour::orderBy('id', 'desc')->take(3)->get();
        return view('index', compact('tours'));
    }
     public function create() {
        return view('admin.tours.create');
    }

    public function store(Request $request) {
        $request->validate([
            'price' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'places' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        Tour::create($request->all());
        return redirect()->route('admin.tours.index')->with('success', 'Tour created successfully!');
    }

    public function edit($id) {
        $tour = Tour::findOrFail($id);
        return view('admin.tours.edit', compact('tour'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'price' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'places' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        $tour = Tour::findOrFail($id);
        $tour->update($request->all());
        return redirect()->route('admin.tours.index')->with('success', 'Tour updated successfully!');
    }

    public function destroy($id) {
        $tour = Tour::findOrFail($id);
        $tour->delete();
        return redirect()->route('admin.tours.index')->with('success', 'Tour deleted successfully!');
    }
    public function show($id) {
        $tour = Tour::findOrFail($id);
        return view('admin.tours.show', compact('tour'));
    }
}

