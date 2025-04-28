@extends('layouts.navigation')

@section('content')
<div class="container">
    <h1 class="mb-4">Створити пост</h1>
    <form action="{{ route('post.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="description">Опис</label>
            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="country_id">Країна</label>
            <select class="form-control" id="country_id" name="country_id" required>
                <option value="">Оберіть країну</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="city_id">Місто</label>
            <select class="form-control" id="city_id" name="city_id" required>
                <option value="">Оберіть місто</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tag_id">Тег</label>
            <select class="form-control" id="tag_id" name="tag_id" required>
                <option value="">Оберіть місто</option>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Створити пост</button>
    </form>
</div>
@endsection
