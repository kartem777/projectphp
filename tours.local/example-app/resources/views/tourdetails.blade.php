@extends('layouts.navigation')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">{{ $tour->name }}</h1>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Price:</strong> ${{ $tour->price }}</p>
                <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($tour->start)->format('M d, Y') }}</p>
                <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($tour->end)->format('M d, Y') }}</p>
                <p><strong>Places Available:</strong> {{ $tour->places }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Description:</strong></p>
                <p class="text-wrap">{{ $tour->description }}</p>
                <p><strong>City:</strong> {{ $tour->city->name }}</p>
                <p><strong>Country:</strong> {{ $tour->country->name }}</p>
                <p><strong>Tag:</strong> {{ $tour->tag->name }}</p>
            </div>
        </div>

        <div class="mt-4">
            <h3>Images:</h3>
            <div class="row">
                @foreach($tour->images as $image)
                    <div class="col-md-4">
                        <img src="{{ asset($image->url) }}" alt="Tour Image" class="img-fluid mb-3" width="200" height="200">
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('bookings.create', $tour->id) }}" class="btn btn-warning">Book Tour</a>
        </div>
    </div>
@endsection
