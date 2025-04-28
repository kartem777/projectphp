<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\Request;

class BookingController extends Controller
{
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

        $booking = new Booking($validated);
        $booking->user()->associate($request->user());
        $booking->tour()->associate($tour);
        $booking->save();

        return redirect()->route('home')->with('success', 'Тур успішно заброньовано!');
    }

    public function edit(Booking $booking)
    {
        return view('bookings.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $booking->update([
            'adults_count' => $request->input('adults_count'),
            'children_count' => $request->input('children_count'),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('home')->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->back()->with('success', 'Booking cancelled successfully.');
    }
}

