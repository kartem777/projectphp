@extends('layouts.navigation')

@section('content')
    <h1>Edit Tour</h1>
    <form action="{{ route('admin.tours.update', $tour->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" value="{{ $tour->title }}" required>
        </div>
        <div>
            <label for="price">Price</label>
            <input type="number" name="price" value="{{ $tour->price }}" required>
        </div>
        <div>
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" value="{{ $tour->start_date->format('Y-m-d') }}" required>
        </div>
        <div>
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" value="{{ $tour->end_date->format('Y-m-d') }}" required>
        </div>
        <div>
            <label for="places">Places</label>
            <input type="number" name="places" value="{{ $tour->places }}" required>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description">{{ $tour->description }}</textarea>
        </div>
        <div>
            <label for="city">City</label>
            <input type="text" name="city" value="{{ $tour->city }}" required>
        </div>
        <div>
            <label for="country">Country</label>
            <input type="text" name="country" value="{{ $tour->country }}" required>
        </div>
        <button type="submit">Update Tour</button>
    </form>
@endsection
