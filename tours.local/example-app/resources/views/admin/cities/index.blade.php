@extends('layouts.navigationadmin')

@section('content')
<div class="container mt-5">
    <h1>All Cities</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.cities.create') }}" class="btn btn-primary mb-3">Create New City</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cities as $city)
                <tr>
                    <td>{{ $city->name }}</td>
                    <td>
                        <a href="{{ route('admin.cities.show', $city->id) }}" class="btn btn-info btn-sm">Show</a>
                        <a href="{{ route('admin.cities.edit', $city->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.cities.destroy', $city->id) }}" method="POST" style="display:inline;">
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
