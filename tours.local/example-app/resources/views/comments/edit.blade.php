@extends('layouts.app')

@section('content')
<div class="container">
    <h5>Редагувати коментар</h5>
    <form action="{{ route('comments.update', $comment) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="body" class="form-label">Текст коментаря</label>
            <textarea name="body" id="body" rows="3" class="form-control">{{ old('body', $comment->body) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Зберегти</button>
    </form>
</div>
@endsection
