@extends('layouts.navigationadmin')

@section('title', 'Users')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Users</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Create User</a>
    </div>

    @foreach($users as $user)
        <div class="card mb-2">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $user->name }}</strong> ({{ $user->email }})
                </div>
                <div>
                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
