@extends('layouts.navigation')

@section('content')
    <h1>Tours</h1>
    <a href="{{ route('admin.tours.create') }}">Create New Tour</a>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Price</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tours as $tour)
                <tr>
                    <td>{{ $tour->title }}</td>
                    <td>{{ $tour->price }}</td>
                    <td>{{ $tour->start_date->format('Y-m-d') }}</td>
                    <td>{{ $tour->end_date->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('admin.tours.edit', $tour->id) }}">Edit</a>
                        <form action="{{ route('admin.tours.destroy', $tour->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
