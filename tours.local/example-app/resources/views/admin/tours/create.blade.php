@extends('layouts.navigation')

@section('content')
    <h1>Create New Tour</h1>
    <form action="{{ route('admin.tours.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" required>
        </div>
        <div>
            <label for="price">Price</label>
            <input type="number" name="price" required>
        </div>
        <div>
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" required>
        </div>
        <div>
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" required>
        </div>
        <div>
            <label for="places">Places</label>
            <input type="number" name="places" required>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description"></textarea>
        </div>
        <div>
            <label for="city">City</label>
            <input type="text" name="city" required>
        </div>
        <div>
            <label for="country">Country</label>
            <input type="text" name="country" required>
        </div>
        <button type="submit">Create Tour</button>
    </form>
@endsection
