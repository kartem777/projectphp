@extends('layouts.navigationadmin')

@section('content')
<div class="container">
    <h1 class="mb-4">Feedbacks</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($feedbacks->isEmpty())
        <p>No feedbacks yet.</p>
    @else
        @foreach($feedbacks as $feedback)
            <div class="card mb-3">
                <div class="card-body">
                    <p class="mb-1">{{ $feedback->description }}</p>
                    <small class="text-muted">
                        From: {{ $feedback->user->name ?? 'Unknown User' }}
                    </small>

                    <form action="{{ route('admin.feedbacks.destroy', $feedback->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>

                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
