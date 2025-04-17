@extends('layouts.navigation')

@section('content')
<div class="container">
    <h2>Зворотній зв'язок</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('feedback.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Надіслати</button>
    </form>

</div>
@endsection
