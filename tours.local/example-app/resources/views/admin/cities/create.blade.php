@extends('layouts.navigationadmin')

@section('content')
<div class="container mt-5">
    <h1>Create New City</h1>
    <form action="{{ route('admin.cities.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">City Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create City</button>
    </form>
</div>
@endsection
