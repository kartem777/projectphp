@extends('layouts.navigationadmin')

@section('content')
<div class="container mt-5">
    <h1>Edit Tag</h1>
    <form action="{{ route('admin.tags.update', $tag->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Tag Name</label>
            <input type="text" name="name" class="form-control" value="{{ $tag->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Tag</button>
    </form>
</div>
@endsection
