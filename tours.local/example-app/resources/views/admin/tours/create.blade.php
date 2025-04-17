@extends('layouts.navigationadmin')

@section('content')
    <div class="container mt-5">
        <h1>Create New Tour</h1>
        <form action="{{ route('admin.tours.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="start" class="form-label">Start Date</label>
                <input type="date" name="start" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="end" class="form-label">End Date</label>
                <input type="date" name="end" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="places" class="form-label">Places</label>
                <input type="number" name="places" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <select name="city" class="form-control" required>
                    <option value="">Select City</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->name }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select name="country" class="form-control" required>
                    <option value="">Select Country</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="tag" class="form-label">Tag</label>
                <select name="tag" class="form-control" required>
                    <option value="">Select Tag</option>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create Tour</button>
        </form>
    </div>
@endsection
