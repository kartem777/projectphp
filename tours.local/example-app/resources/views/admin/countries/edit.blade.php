@extends('layouts.navigationadmin')

@section('content')
<div class="container mt-5">
    <h1>Edit Country</h1>
    <form action="{{ route('admin.countries.update', $country->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Country Name</label>
            <input type="text" name="name" class="form-control" value="{{ $country->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Country</button>
    </form>
</div>
@endsection
