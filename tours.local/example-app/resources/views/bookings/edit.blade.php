@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Booking</h1>

    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="adults_count" class="form-label">Adults Count</label>
            <input type="number" class="form-control" id="adults_count" name="adults_count" value="{{ old('adults_count', $booking->adults_count) }}" min="1" required>
        </div>

        <div class="mb-3">
            <label for="children_count" class="form-label">Children Count</label>
            <input type="number" class="form-control" id="children_count" name="children_count" value="{{ old('children_count', $booking->children_count) }}" min="0" required>
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">Comment</label>
            <textarea class="form-control" id="comment" name="comment" rows="3">{{ old('comment', $booking->comment) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Booking</button>
    </form>
</div>
@endsection
