@extends('layouts.navigation')

@section('title', 'Home Page')

@section('content')
    <div class="text-center">
        <h1>Welcome to Our Travel Agency</h1>
        <p class="lead">Explore the best tours and hot destinations with us.</p>
    </div>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Tour 1">
                <div class="card-body">
                    <h5 class="card-title">Tour 1</h5>
                    <p class="card-text">An exciting journey to beautiful places.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Tour 2">
                <div class="card-body">
                    <h5 class="card-title">Tour 2</h5>
                    <p class="card-text">A breathtaking adventure to unforgettable destinations.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Tour 3">
                <div class="card-body">
                    <h5 class="card-title">Tour 3</h5>
                    <p class="card-text">Discover exotic locations and hidden gems.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
