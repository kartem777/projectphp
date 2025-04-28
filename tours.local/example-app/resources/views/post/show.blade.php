@extends('layouts.navigation')

@section('content')
<div class="container">
    <div class="mt-4">
        <a href="{{ url()->previous() == route('post.index') ? route('post.index') : route('post.myPosts') }}" class="btn btn-secondary">Повернутися назад</a>
    </div>

    <h1>{{ $post->title }}</h1>
    
    <p><strong>Автор:</strong> {{ $post->user->name ?? 'Анонім' }}</p>
    <p><strong>Країна:</strong> {{ $post->country->name ?? '-' }}</p>
    <p><strong>Місто:</strong> {{ $post->city->name ?? '-' }}</p>

    <p>{{ $post->description }}</p>

    <!-- Виводимо всі коментарі посту -->
    <div class="mt-4">
        <h5>Коментарі</h5>
        @foreach($post->comments as $comment)
            <div class="card my-2">
                <div class="card-body">
                    <p class="card-text">{{ $comment->body }}</p>
                    <small class="text-muted">
                        {{ $comment->user->name }} |
                        {{ $comment->created_at->format('d.m.Y H:i') }}
                    </small>
                    <!-- Кнопки редагування/видалення власного коментаря -->
                    @if(auth()->check() && auth()->id() == $comment->user_id)
                        <a href="{{ route('comments.edit', $comment) }}" class="btn btn-sm btn-secondary">Редагувати</a>
                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Видалити</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- Форма додавання коментаря (тільки для авторизованих) -->
    @auth
        <form action="{{ route('comments.store') }}" method="POST" class="mt-3">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="mb-3">
                <label for="body" class="form-label">Ваш коментар</label>
                <textarea name="comment" class="form-control" rows="3" placeholder="Ваш коментар..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Додати коментар</button>
        </form>
    @else
        <p class="mt-3">Щоб залишити коментар, будь ласка, <a href="{{ route('login') }}">увійдіть</a>.</p>
    @endauth

</div>
@endsection
