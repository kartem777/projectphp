@extends('layouts.navigationadmin')

@section('content')
<div class="container mt-5">
    <h1>All Tags</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.tags.create') }}" class="btn btn-primary mb-3">Create New Tag</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tags as $tag)
                <tr>
                    <td>{{ $tag->name }}</td>
                    <td>
                        <a href="{{ route('admin.tags.show', $tag->id) }}" class="btn btn-info btn-sm">Show</a>
                        <a href="{{ route('admin.tags.edit', $tag->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
