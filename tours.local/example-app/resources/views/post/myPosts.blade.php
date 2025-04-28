@extends('layouts.navigation')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Мої пости</h1>
        <a href="{{ route('post.create') }}" class="btn btn-primary">Створити пост</a>
    </div>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('post.myPosts') }}" class="mb-4">
        <div class="row mb-3">
            <!-- Search Input and Button in One Row -->
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="Search by name, city, country, or tag" value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
        </div>

        <!-- Filters and Reset Button in Another Row -->
        <div class="row">
            <!-- Country Filter -->
            <div class="col-md-2">
                <select name="country" class="form-control">
                    <option value="">Select Country</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->name }}" {{ request('country') == $country->name ? 'selected' : '' }}>{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- City Filter -->
            <div class="col-md-2">
                <select name="city" class="form-control">
                    <option value="">Select City</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->name }}" {{ request('city') == $city->name ? 'selected' : '' }}>{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tag Filter -->
            <div class="col-md-2">
                <select name="tag" class="form-control">
                    <option value="">Select Tag</option>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->name }}" {{ request('tag') == $tag->name ? 'selected' : '' }}>{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Reset Button -->
            <div class="col-md-2">
                <a href="{{ route('post.myPosts') }}" class="btn btn-secondary w-100">Reset</a>
            </div>
        </div>
    </form>

    @foreach ($posts as $post)
    <div class="card mb-3">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h5 class="card-title">
                    <a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a>
                </h5>
                <p class="card-text">
                    <small class="text-muted">
                        Автор: {{ $post->users->name ?? 'Анонім' }} <br>
                        Країна: {{ $post->country->name ?? '-' }} 
                        Місто: {{ $post->city->name ?? '-' }}
                    </small>
                </p>
            </div>

            <div class="d-flex">
                <!-- Редагувати, передаючи тільки ID поста -->
                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning me-2">Редагувати</a>

                <!-- Видалити -->
                <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Ви впевнені, що хочете видалити пост?')">Видалити</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
