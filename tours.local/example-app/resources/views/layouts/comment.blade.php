{{-- resources/views/comments/partials/comment.blade.php --}}
<div class="card my-2">
    <div class="card-body">
        <p class="card-text">{{ $comment->comment }}</p>
        <small class="text-muted">
            {{ $comment->user->name }} |
            {{ $comment->created_at->format('d.m.Y H:i') }}
        </small>

        @if(auth()->check() && auth()->id() == $comment->user_id)
            <a href="{{ route('comments.edit', $comment) }}" class="btn btn-sm btn-secondary">Редагувати</a>
            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Видалити</button>
            </form>
        @endif

        @auth
            <button class="btn btn-sm btn-primary mt-2" onclick="toggleReplyForm({{ $comment->id }})">
                Відповісти
            </button>

            <div id="reply-form-{{ $comment->id }}" class="mt-3" style="display: none;">
                <form action="{{ route('comments_comment.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                    <div class="mb-2">
                        <textarea name="comment" class="form-control" rows="2" placeholder="Ваша відповідь..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-sm btn-success">Надіслати</button>
                    <button type="button" class="btn btn-sm btn-link" onclick="toggleReplyForm({{ $comment->id }})">Скасувати</button>
                </form>
            </div>
        @endauth
    </div>

    {{-- Рекурсивно показуємо відповіді --}}
    @if($comment->replies)
        <div class="ms-4">
            @foreach($comment->replies as $reply)
                @include('layouts.comment', ['comment' => $reply])
            @endforeach
        </div>
    @endif
</div>
