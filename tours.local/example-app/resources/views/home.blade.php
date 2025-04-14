@extends('layouts.navigation')

@section('title', 'Home Page')

@section('content')
<h1>Fly around the world Agency</h1>
<div class="row">
    @foreach($tours as $tour)
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">{{ $tour->title }}</h2>
                    <p class="card-text">{{ $tour->description }}</p>
                    <p><strong>City:</strong> {{ $tour->city }}, <strong>Country:</strong> {{ $tour->country }}</p>
                    <p><strong>Price:</strong> ${{ $tour->price }}</p>
                    <p><strong>Dates:</strong> {{ $tour->start_date }} to {{ $tour->end_date }}</p>
                    <p><strong>Places left:</strong> {{ $tour->places }}</p>
                    <p>
                        <strong>Hot Offer:</strong>
                        @if($tour->is_hot_offer)
                            <span class="text-danger">🔥 Yes!</span>
                        @else
                            <span class="text-muted">❄️ Not really</span>
                        @endif
                    </p>

                    <div class="row">
                        @foreach($tour->images as $index => $image)
                            @if($index == 0)
                                <div class="col-12">
                                    <img src="{{ $image->url }}" alt="Tour Image" class="img-fluid" style="max-height: 200px; object-fit: cover;">
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
