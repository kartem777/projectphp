<div class="card my-2" id="comment-{{ $comment->id }}">
    <div class="card-body">

        {{-- Відображення коментаря --}}
        <div id="comment-text-{{ $comment->id }}">
            <p class="card-text">{{ $comment->comment }}</p>
            <small class="text-muted">
                {{ $comment->user->name }} |
                {{ $comment->created_at->format('d.m.Y H:i') }}
            </small>

            @if(auth()->check() && auth()->id() == $comment->user_id)
                <button class="btn btn-sm btn-secondary" onclick="toggleEditForm({{ $comment->id }})">Редагувати</button>
                <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Видалити</button>
                </form>
            @endif
        </div>

        {{-- Форма редагування --}}
        <div id="edit-form-{{ $comment->id }}" style="display: none;">
            <form action="{{ route('comments.update', $comment) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-2">
                    <textarea name="body" class="form-control" rows="3" required>{{ $comment->comment }}</textarea>
                </div>
                <button type="submit" class="btn btn-sm btn-success">Зберегти</button>
                <button type="button" class="btn btn-sm btn-link" onclick="toggleEditForm({{ $comment->id }})">Скасувати</button>
            </form>
        </div>

        {{-- Відповісти --}}
        @auth
            <button class="btn btn-sm btn-primary mt-2" onclick="toggleReplyForm({{ $comment->id }})">
                Відповісти
            </button>

            <div id="reply-form-{{ $comment->id }}" class="mt-3" style="display: none;">
                <form action="{{ route('comments_comment.store') }}" method="POST">
                    @csrf
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

    {{-- Вкладені коментарі --}}
    @if($comment->replies)
        <div class="ms-4">
            @foreach($comment->replies as $reply)
                @include('layouts.comment', ['comment' => $reply])
            @endforeach
        </div>
    @endif
</div>


