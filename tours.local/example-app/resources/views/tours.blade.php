@extends('layouts.navigation')

@section('title', 'All Tours')

@section('content')
<h1>All Tours</h1>
<hr/>

<!-- Filter Form -->
<form method="GET" action="{{ route('tours.basic') }}" class="mb-4">
    <div class="row mb-3">
        <!-- Search Input and Button in One Row -->
        <div class="col-md-6">
            <input type="text" name="search" class="form-control" placeholder="Search by name, city, country, or tag" value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Search</button>
        </div>
        <div class="col-md-2 d-flex align-items-center">
            <input type="checkbox" name="hot_offer" value="1" id="hot_offer" class="custom-checkbox" {{ request('hot_offer') ? 'checked' : '' }}>
            <label for="hot_offer" class="hot-offer-label">-->Hot Offer</label>
        </div>
    </div>

    <!-- Filters in Another Row -->
    <div class="row">
        <!-- Country Filter -->
        <div class="col-md-2">
            <select name="country" class="form-control">
                <option value="">Select Country</option>
                @foreach($countries as $country)
                    <option value="{{ $country->name }}" {{ request('country') == $country->name ? 'selected' : '' }}>{{ $country->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- City Filter -->
        <div class="col-md-2">
            <select name="city" class="form-control">
                <option value="">Select City</option>
                @foreach($cities as $city)
                    <option value="{{ $city->name }}" {{ request('city') == $city->name ? 'selected' : '' }}>{{ $city->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Price Filter -->
        <div class="col-md-2">
            <input type="number" name="price_min" class="form-control" placeholder="Min Price" value="{{ request('price_min') }}">
        </div>
        <div class="col-md-2">
            <input type="number" name="price_max" class="form-control" placeholder="Max Price" value="{{ request('price_max') }}">
        </div>

        <!-- Tag Filter -->
        <div class="col-md-2">
            <select name="tag" class="form-control">
                <option value="">Select Tag</option>
                @foreach($tags as $tag)
                    <option value="{{ $tag->name }}" {{ request('tag') == $tag->name ? 'selected' : '' }}>{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>

<!-- Tours Display -->
<div class="row">
    @foreach($tours as $tour)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($tour->images->isNotEmpty())
                    <img src="{{ $tour->images->first()->url }}" alt="Tour Image" class="card-img-top" style="height: 200px; object-fit: cover;">
                @endif
                <div class="card-body d-flex flex-column">
                    <h2 class="card-title">{{ $tour->name }}</h2>
                    <p class="card-text">{{ Str::limit($tour->description, 100) }}</p>
                    <p><strong>City:</strong> {{ $tour->city->name }}, <strong>Country:</strong> {{ $tour->country->name }}</p>
                    <p><strong>Tag:</strong> {{ $tour->tag->name }}</p>
                    <p><strong>Price:</strong> ${{ $tour->price }}</p>
                    <p><strong>Dates:</strong> {{ $tour->formatted_start }} to {{ $tour->formatted_end }}</p>
                    <p><strong>Places left:</strong> {{ $tour->places }}</p>
                    <p>
                        <strong>Hot Offer:</strong>
                        @if($tour->is_hot_offer)
                            <span class="text-danger">🔥 Yes!</span>
                        @else
                            <span class="text-muted">❄️ Not really</span>
                        @endif
                    </p>
                    <div class="mt-auto">
                        <a href="#" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
