@extends('layouts.navigation')

@section('content')
<div class="container">
    <h1>Редагувати пост</h1>

    <form method="POST" action="{{ route('post.update', $post->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="title" class="form-label">Заголовок</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}" required>
    </div>

    <div class="mb-3">
        <label for="content" class="form-label">Зміст</label>
        <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description', $post->description) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="country" class="form-label">Країна</label>
        <select class="form-control" id="country" name="country" required>
            @foreach($countries as $country)
                <option value="{{ $country->id }}" {{ old('country', $post->country->id) == $country->id ? 'selected' : '' }}>
                    {{ $country->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="city" class="form-label">Місто</label>
        <select class="form-control" id="city" name="city" required>
            @foreach($cities as $city)
                <option value="{{ $city->id }}" {{ old('city', $post->city->id) == $city->id ? 'selected' : '' }}>
                    {{ $city->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="tag" class="form-label">Тег</label>
        <select class="form-control" id="tag" name="tag" required>
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}" {{ old('tag', $post->tag->id ?? '') == $tag->id ? 'selected' : '' }}>
                    {{ $tag->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Оновити пост</button>
</form>

</div>
@endsection
