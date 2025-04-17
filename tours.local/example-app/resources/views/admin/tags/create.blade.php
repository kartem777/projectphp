@extends('layouts.navigationadmin')

@section('content')
<div class="container mt-5">
    <h1>Create New Tag</h1>
    <form action="{{ route('admin.tags.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tag Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Tag</button>
    </form>
</div>
@endsection
