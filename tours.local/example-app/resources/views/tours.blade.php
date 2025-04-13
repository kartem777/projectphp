@extends('layouts.navigation')

@section('title', 'Home Page')

@section('content')
    <h1>All Tours</h1>
    <hr/>
    @foreach($tours as $tour)
        <div style="margin-bottom: 20px;">
            <h2>{{ $tour->title }}</h2>
            <p>{{ $tour->description }}</p>
            <p><strong>City:</strong> {{ $tour->city }}, <strong>Country:</strong> {{ $tour->country }}</p>
            <p><strong>Price:</strong> ${{ $tour->price }}</p>
            <p><strong>Dates:</strong> {{ $tour->start_date }} to {{ $tour->end_date }}</p>
            <p><strong>Places left:</strong> {{ $tour->places }}</p>
            <p>
                <strong>Hot Offer:</strong>
                @if($tour->is_hot_offer)
                    🔥 Yes!
                @else
                    ❄️ Not really
                @endif
            </p>
            @foreach($tour->images as $image)
            <img src="{{ $image->url }}" alt="Tour Image" width="150" height="100">
            @endforeach
        </div>
        <hr/>
    @endforeach

@endsection
