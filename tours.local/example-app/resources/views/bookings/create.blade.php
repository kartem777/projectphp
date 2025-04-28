@extends('layouts.app')

@section('content')
<h2>Бронювання туру: {{ $tour->name }}</h2>

<form method="POST" action="{{ route('bookings.store', $tour) }}">
    @csrf

    <div>
        <label for="adults_count">Кількість дорослих:</label>
        <input type="number" name="adults_count" id="adults_count" min="1" required>
        @error('adults_count')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="children_count">Кількість дітей:</label>
        <input type="number" name="children_count" id="children_count" min="0" required>
        @error('children_count')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="comment">Коментар (необов'язково):</label>
        <textarea name="comment" id="comment"></textarea>
        @error('comment')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">Забронювати</button>
</form>
@endsection
