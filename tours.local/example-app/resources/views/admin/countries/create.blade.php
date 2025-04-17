@extends('layouts.navigationadmin')

@section('content')
<div class="container mt-5">
    <h1>Create New Country</h1>
    <form action="{{ route('admin.countries.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Country Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Country</button>
    </form>
</div>
@endsection
