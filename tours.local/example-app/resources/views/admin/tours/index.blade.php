@extends('layouts.navigationadmin')

@section('content')
<div class="container">
    <h1>All Tours</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.tours.create') }}" class="btn btn-primary mb-3">Create New Tour</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Places left</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>City</th>
                <th>Country</th>
                <th>Tag</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tours as $tour)
            <tr>
                <td>{{ $tour->name }}</td>
                <td>{{ $tour->price }}</td>
                <td>{{ $tour->places }}</td>
                <td>{{ $tour->formatted_start }}</td>
                <td>{{ $tour->formatted_end }}</td>
                <td>{{ $tour->city->name }}</td>
                <td>{{ $tour->country->name }}</td>
                <td>{{ $tour->tag->name }}</td>
                <td>
                    <!-- Show Button -->
                    <a href="{{ route('admin.tours.show', $tour->id) }}" class="btn btn-info btn-sm">Show</a>
                    
                    <!-- Edit Button -->
                    <a href="{{ route('admin.tours.edit', $tour->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    
                    <!-- Delete Button -->
                    <form action="{{ route('admin.tours.destroy', $tour->id) }}" method="POST" style="display:inline;">
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
