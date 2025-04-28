@extends('layouts.navigationadmin')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Booking</h1>
    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="adults_count">Adults Count</label>
            <input type="number" id="adults_count" name="adults_count" class="form-control" value="{{ old('adults_count', $booking->adults_count) }}" required min="1">
        </div>

        <div class="form-group">
            <label for="children_count">Children Count</label>
            <input type="number" id="children_count" name="children_count" class="form-control" value="{{ old('children_count', $booking->children_count) }}" required min="0">
        </div>

        <div class="form-group">
            <label for="comment">Comment</label>
            <textarea id="comment" name="comment" class="form-control">{{ old('comment', $booking->comment) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Booking</button>
    </form>
</div>
@endsection
