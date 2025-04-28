@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4 class="mt-4">Your Bookings:</h4>

                    @if($bookings->isEmpty())
                        <p>You have no bookings yet.</p>
                    @else
                        <ul class="list-group">
                            @foreach($bookings as $booking)
                                <li class="list-group-item">
                                    <strong>Tour:</strong> {{ $booking->tour->name }} <br>
                                    <strong>Adults:</strong> {{ $booking->adults_count }} |
                                    <strong>Children:</strong> {{ $booking->children_count }} <br>
                                    <strong>Comment:</strong> {{ $booking->comment ?? 'No comment' }}

                                    <div class="mt-2">
                                        <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-primary btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to cancel this booking?')">
                                                Cancel
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
