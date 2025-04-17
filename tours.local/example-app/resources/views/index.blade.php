@extends('layouts.navigation')

@section('title', 'Home Page')

@section('content')
<h1>Fly around the world Agency</h1>
<div class="row">
    @foreach($tours as $tour)
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                @if($tour->images->isNotEmpty())
                    <img src="{{ $tour->images->first()->url }}" alt="Tour Image" class="card-img-top" style="max-height: 200px; object-fit: cover;">
                @endif
                <div class="card-body d-flex flex-column">
                    <h2 class="card-title">{{ $tour->name }}</h2>
                    <p class="card-text">{{ Str::limit($tour->description, 100) }}</p>
                    <p><strong>City:</strong> {{ $tour->city->name }}, <strong>Country:</strong> {{ $tour->country->name }}</p>
                    <p><strong>Tag:</strong> {{ $tour->tag->name }}</p>
                    <p><strong>Price:</strong> ${{ $tour->price }}</p>
                    <p><strong>Dates:</strong> {{ $tour->formatted_start }} — {{ $tour->formatted_end }}</p>
                    <p><strong>Places left:</strong> {{ $tour->places }}</p>
                    <p>
                        <strong>Hot Offer:</strong>
                        @if($tour->is_hot_offer)
                            <span class="text-danger">🔥 Yes!</span>
                        @else
                            <span class="text-muted">❄️ Not really</span>
                        @endif
                    </p>
                    <a href="#" class="btn btn-primary mt-auto">View Details</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
