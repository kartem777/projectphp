@extends('layouts.navigationadmin')

@section('content')
<div class="container">
    <h1 class="mb-4">Bookings</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($bookings->isEmpty())
        <p>No bookings yet.</p>
    @else
        <div class="list-group">
            @foreach($bookings as $booking)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h5>{{ $booking->tour->name }}</h5>
                        <p>Booked by: {{ $booking->user->name }}</p>
                        <p>Adults: {{ $booking->adults_count }}, Children: {{ $booking->children_count }}</p>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-warning">Edit</a>

                        <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this booking?')">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
