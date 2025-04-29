@extends('layouts.navigation')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">{{ $tour->name }}</h1>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Price:</strong> ${{ $tour->price }}</p>
            <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($tour->start)->format('M d, Y') }}</p>
            <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($tour->end)->format('M d, Y') }}</p>
            <p><strong>Places Available:</strong> {{ $tour->places }}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Description:</strong></p>
            <p class="text-wrap">{{ $tour->description }}</p>
            <p><strong>City:</strong> {{ $tour->city->name }}</p>
            <p><strong>Country:</strong> {{ $tour->country->name }}</p>
            <p><strong>Tag:</strong> {{ $tour->tag->name }}</p>
        </div>
    </div>

    <div class="mt-4">
        <h3>Images:</h3>
        <div class="row">
            @foreach($tour->images as $image)
                <div class="col-md-4">
                    <img src="{{ asset($image->url) }}" alt="Tour Image" class="img-fluid mb-3" width="200" height="200">
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('bookings.create', $tour->id) }}" class="btn btn-warning">Book Tour</a>
    </div>

    <!-- Коментарі -->
    <div class="mt-5">
        <h5>Коментарі</h5>
        @foreach($tour->comments->whereNull('comment_id') as $comment)
            @include('layouts.comment', ['comment' => $comment])
        @endforeach
    </div>

    <!-- Форма додавання нового коментаря -->
    @auth
        <form action="{{ route('comments_tour.store') }}" method="POST" class="mt-3">
            @csrf
            <input type="hidden" name="tour_id" value="{{ $tour->id }}">
            <div class="mb-3">
                <label for="comment" class="form-label">Ваш коментар</label>
                <textarea name="comment" class="form-control" rows="3" placeholder="Ваш коментар..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Додати коментар</button>
        </form>
    @else
        <p class="mt-3">Щоб залишити коментар, будь ласка, <a href="{{ route('login') }}">увійдіть</a>.</p>
    @endauth
</div>

<!-- JavaScript для відкриття/закриття форм відповіді -->
<script>
    function toggleReplyForm(commentId) {
        const form = document.getElementById('reply-form-' + commentId);
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
</script>
@endsection

