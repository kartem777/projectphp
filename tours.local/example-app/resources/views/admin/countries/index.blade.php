@extends('layouts.navigationadmin')

@section('content')
<div class="container mt-5">
    <h1>All Countries</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.countries.create') }}" class="btn btn-primary mb-3">Create New Country</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($countries as $country)
                <tr>
                    <td>{{ $country->name }}</td>
                    <td>
                        <a href="{{ route('admin.countries.show', $country->id) }}" class="btn btn-info btn-sm">Show</a>
                        <a href="{{ route('admin.countries.edit', $country->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.countries.destroy', $country->id) }}" method="POST" style="display:inline;">
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
