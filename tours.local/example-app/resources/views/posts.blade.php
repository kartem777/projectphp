@extends('layouts.navigation')

@section('title', 'Home Page')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2>All Posts</h2>
        <a href="{{ route('.user.createposts') }}" style="padding: 8px 16px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">
            Add Post
        </a>
    </div>
    <hr/>

    @foreach($posts as $post)
        <div style="margin-bottom: 20px;">
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->content }}</p>
        </div>
        <hr/>
    @endforeach
@endsection
