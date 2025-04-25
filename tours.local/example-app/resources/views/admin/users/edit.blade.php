@extends('layouts.navigationadmin')

@section('title', 'Edit User')

@section('content')
    <h1>Edit User</h1>
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf @method('PUT')
        @include('admin.users.form')
        <button type="submit" class="btn btn-primary mt-2">Update</button>
    </form>
@endsection
