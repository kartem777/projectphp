@extends('layouts.navigationadmin')

@section('title', 'Create User')

@section('content')
    <h1>Create User</h1>
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        @include('admin.users.form')
        <button type="submit" class="btn btn-success mt-2">Create</button>
    </form>
@endsection
