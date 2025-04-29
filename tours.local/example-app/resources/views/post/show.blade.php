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
    <div class="mt-5">
        <h5>Коментарі</h5>
        @foreach($post->comments->whereNull('comment_id') as $comment)
            @include('layouts.comment', ['comment' => $comment])
        @endforeach
    </div>

    <!-- Форма додавання нового коментаря до поста (тільки для авторизованих) -->
    @auth
        <form action="{{ route('comments_post.store') }}" method="POST" class="mt-3">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <div class="mb-3">
                <label for="comment" class="form-label">Ваш коментар</label>
                <textarea name="comment" class="form-control" rows="3" placeholder="Ваш коментар..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Додати коментар</button>
        </form>
    @else
        <p class="mt-3">Щоб залишити коментар, будь ласка, <a href="{{ route('login') }}">увійдіть</a>.</p>
    @endauth

</div>

<!-- Невеличкий JavaScript для відкриття/закриття форми відповіді -->
<script>
    function toggleReplyForm(commentId) {
        const form = document.getElementById('reply-form-' + commentId);
        if (form.style.display === 'none') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    }
</script>
@endsection
