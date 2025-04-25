@extends('layouts.navigationadmin')

@section('title', 'User Details')

@section('content')
    <h1>{{ $user->name }}</h1>
    <ul class="list-group">
        <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
        <li class="list-group-item"><strong>Phone:</strong> {{ $user->phone_number }}</li>
        <li class="list-group-item"><strong>Admin:</strong> {{ $user->is_admin ? 'Yes' : 'No' }}</li>
    </ul>
    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning mt-3">Edit</a>
@endsection
