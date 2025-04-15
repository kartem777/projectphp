@extends('layouts.navigation')

@section('title', 'Create Post')

@section('content')
    <h1>Create New Post</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div style="margin-bottom: 10px;">
            <label for="title">Title:</label><br>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label for="content">Content:</label><br>
            <textarea name="content" id="content" rows="5" required>{{ old('content') }}</textarea>
        </div>

        <div style="margin-bottom: 10px;">
            <label for="photo">Photo (optional):</label><br>
            <input type="file" name="photo" id="photo">
        </div>

        <button type="submit" style="padding: 8px 16px; background-color: #4CAF50; color: white; border: none; border-radius: 4px;">
            Submit Post
        </button>
    </form>
@endsection
