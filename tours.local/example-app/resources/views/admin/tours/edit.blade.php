@extends('layouts.navigationadmin')

@section('content')
    <div class="container mt-5">
        <h1>Edit Tour</h1>
        <form action="{{ route('admin.tours.update', $tour->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" value="{{ old('name', $tour->name) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $tour->price) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="start" class="form-label">Start Date</label>
                <input type="date" name="start" value="{{ old('start', \Carbon\Carbon::parse($tour->start)->format('Y-m-d')) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="end" class="form-label">End Date</label>
                <input type="date" name="end" value="{{ old('end', \Carbon\Carbon::parse($tour->end)->format('Y-m-d')) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="places" class="form-label">Places</label>
                <input type="number" name="places" value="{{ old('places', $tour->places) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control">{{ old('description', $tour->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" name="city" value="{{ old('city', $tour->city->name ?? '') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <input type="text" name="country" value="{{ old('country', $tour->country->name ?? '') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="tag" class="form-label">Tag</label>
                <input type="text" name="tag" value="{{ old('tag', $tour->tag->name ?? '') }}" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Tour</button>
        </form>
    </div>
@endsection
