<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
    $bookings = Booking::all();
    return view('admin.bookings.index', compact('bookings'));
    }
    public function create(Tour $tour)
    {
        return view('bookings.create', compact('tour'));
    }

    public function store(Request $request, Tour $tour)
    {
        $validated = $request->validate([
            'adults_count'   => 'required|integer|min:1',
            'children_count' => 'required|integer|min:0',
            'comment'        => 'nullable|string',
        ]);

        $totalPeople = $validated['adults_count'] + $validated['children_count'];

        if ($totalPeople > $tour->places) {
            return redirect()->back()->with('error', 'Not enough places available for this tour.');
        }

        $booking = new Booking($validated);
        $booking->user()->associate($request->user());
        $booking->tour()->associate($tour);
        $booking->save();

        $tour->places -= $totalPeople;
        $tour->save();

        return redirect()->route('home')->with('success', 'Tour successfully booked!');
    }


    public function edit(Booking $booking)
    {
        return view('bookings.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'adults_count'   => 'required|integer|min:1',
            'children_count' => 'required|integer|min:0',
            'comment'        => 'nullable|string',
        ]);

        $totalPeople = $validated['adults_count'] + $validated['children_count'];
        $tour = $booking->tour;

        $oldTotalPeople = $booking->adults_count + $booking->children_count;

        if ($totalPeople - $oldTotalPeople > $tour->places) {
            return redirect()->back()->with('error', 'Not enough places available for this tour.');
        }

        $booking->update($validated);

        $tour->places += $oldTotalPeople - $totalPeople;
        $tour->save();

        $redirectRoute = strpos(url()->previous(), route('admin.bookings.edit', $booking->id)) === 0
            ? route('admin.bookings.index')
            : route('home');

        return redirect($redirectRoute)->with('success', 'Booking updated successfully.');
    }


    public function destroy(Booking $booking)
    {
        $tour = $booking->tour;
        $tour->places += $booking->adults_count + $booking->children_count;
        $tour->save();

        $booking->delete();

        return redirect()->back()->with('success', 'Booking cancelled successfully.');
    }
    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

}

