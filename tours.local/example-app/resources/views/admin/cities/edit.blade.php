@extends('layouts.navigationadmin')

@section('content')
<div class="container mt-5">
    <h1>Edit City</h1>
    <form action="{{ route('admin.cities.update', $city->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">City Name</label>
            <input type="text" name="name" class="form-control" value="{{ $city->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update City</button>
    </form>
</div>
@endsection
