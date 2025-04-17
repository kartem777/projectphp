@extends('layouts.navigation')

@section('content')
<div class="container">
    <div class="mt-4">
        <a href="{{ route('post.index') }}" class="btn btn-secondary">Повернутися до списку постів</a>
    </div>

    <h1>{{ $post->title }}</h1>
    
    <p><strong>Автор:</strong> {{ $post->user->name ?? 'Анонім' }}</p>
    <p><strong>Країна:</strong> {{ $post->country->name ?? '-' }}</p>
    <p><strong>Місто:</strong> {{ $post->city->name ?? '-' }}</p>

    <p>{{ $post->description }}</p>
</div>
@endsection
