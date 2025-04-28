@extends('layouts.navigationadmin')

@section('content')
<div class="container">
    <h1 class="mb-4">Booking Details</h1>

    <div class="card">
        <div class="card-body">
            <h3>{{ $booking->tour->name }}</h3>
            <p><strong>Booked by:</strong> {{ $booking->user->name }}</p>
            <p><strong>Adults:</strong> {{ $booking->adults_count }}</p>
            <p><strong>Children:</strong> {{ $booking->children_count }}</p>
            <p><strong>Comment:</strong> {{ $booking->comment ?? 'No comments' }}</p>

            <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-warning">Edit</a>

            <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this booking?')">Delete</button>
            </form>

            <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Back to Bookings</a>
        </div>
    </div>
</div>
@endsection
