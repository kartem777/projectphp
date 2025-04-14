@extends('layouts.app')

@section('content')
    <div class="tour-details">
        <h1>{{ $tour->title }}</h1>
        <p>Price: ${{ $tour->price }}</p>
        <p>Start Date: {{ $tour->start_date }}</p>
        <p>End Date: {{ $tour->end_date }}</p>
        <p>Places Available: {{ $tour->places }}</p>
        <p>Description: {{ $tour->description }}</p>
        <p>City: {{ $tour->city }}</p>
        <p>Country: {{ $tour->country }}</p>

        <a href="{{ route('admin.tours.edit', $tour->id) }}">Edit Tour</a>
        <form action="{{ route('admin.tours.destroy', $tour->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </div>
@endsection
