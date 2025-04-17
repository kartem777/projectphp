@extends('layouts.navigationadmin')

@section('content')
<div class="container mt-5">
    <h1>City: {{ $city->name }}</h1>

    <h4 class="mt-4">Associated Tours</h4>
    @if($city->tours->count() > 0)
        <ul class="list-group">
            @foreach($city->tours as $tour)
                <li class="list-group-item">
                    {{ $tour->name }} — {{ $tour->price }}$
                </li>
            @endforeach
        </ul>
    @else
        <p>No tours linked to this city yet.</p>
    @endif

    <a href="{{ route('admin.cities.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
