@extends('layouts.app')

<!-- Підключення Bootstrap через CDN -->
@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJx3aJXf3Y6mo5r56ZlMjzj0PT1NS0T9RUGv3qEwzP2Hqg0sqZG45KT3PSgS" crossorigin="anonymous">
@endsection

@section('content')
<div class="container mt-5">
    <h2>Бронювання туру: {{ $tour->name }}</h2>

    <form method="POST" action="{{ route('bookings.store', $tour) }}">
        @csrf

        <div class="mb-3">
            <label for="adults_count" class="form-label">Кількість дорослих:</label>
            <input type="number" name="adults_count" id="adults_count" class="form-control" min="1" required>
            @error('adults_count')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="children_count" class="form-label">Кількість дітей:</label>
            <input type="number" name="children_count" id="children_count" class="form-control" min="0" required>
            @error('children_count')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">Коментар (необов'язково):</label>
            <textarea name="comment" id="comment" class="form-control"></textarea>
            @error('comment')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Забронювати</button>
    </form>
</div>

<!-- Підключення JS для Bootstrap (потрібно для деяких компонентів, таких як спливаючі повідомлення) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBfYfD5F8L2z3kK4xqvFeTk4lV99L9CCq6e9t0pS1G8w3W4w" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0v8FqWbBlAptj5lnA1LE1YgR8B+Xy5Wyw5f7kNEX6uZGQntz" crossorigin="anonymous"></script>
@endsection
