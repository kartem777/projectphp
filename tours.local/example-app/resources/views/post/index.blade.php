@extends('layouts.navigation')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Усі пости</h1>
        <a href="{{ route('post.create') }}" class="btn btn-primary">Створити пост</a>
    </div>

    @foreach ($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a>
                </h5>
                <p class="card-text">
                    <small class="text-muted">
                        Автор: {{ $post->users->name ?? 'Анонім' }} <br>
                        Країна: {{ $post->country->name ?? '-' }} 
                        Місто: {{ $post->city->name ?? '-' }} <br>
                    </small>
            </div>
        </div>
    @endforeach

</div>
@endsection
