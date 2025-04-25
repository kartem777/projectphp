@extends('layouts.navigationadmin')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Tour</h2>

    <form action="{{ route('admin.tours.update', $tour->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Tour Info Fields --}}
        <div class="mb-3"><label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $tour->name }}" required>
        </div>

        <div class="mb-3"><label class="form-label">Price</label>
            <input type="number" name="price" class="form-control" value="{{ $tour->price }}" required>
        </div>

        <div class="mb-3"><label class="form-label">Start Date</label>
            <input type="date" name="start" class="form-control" value="{{ $tour->start }}" required>
        </div>

        <div class="mb-3"><label class="form-label">End Date</label>
            <input type="date" name="end" class="form-control" value="{{ $tour->end }}" required>
        </div>

        <div class="mb-3"><label class="form-label">Places</label>
            <input type="number" name="places" class="form-control" value="{{ $tour->places }}" required>
        </div>

        <div class="mb-3"><label class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ $tour->description }}</textarea>
        </div>

        {{-- Dropdowns --}}
        <div class="mb-3"><label class="form-label">City</label>
            <select name="city" class="form-control" required>
                @foreach($cities as $city)
                    <option value="{{ $city->name }}" {{ $tour->city_id === $city->id ? 'selected' : '' }}>
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3"><label class="form-label">Country</label>
            <select name="country" class="form-control" required>
                @foreach($countries as $country)
                    <option value="{{ $country->name }}" {{ $tour->country_id === $country->id ? 'selected' : '' }}>
                        {{ $country->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3"><label class="form-label">Tag</label>
            <select name="tag" class="form-control" required>
                @foreach($tags as $tag)
                    <option value="{{ $tag->name }}" {{ $tour->tag_id === $tag->id ? 'selected' : '' }}>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Current Images --}}
        <hr>
        <div class="mb-3">
            <label class="form-label">Current Images</label>
            <div class="d-flex flex-wrap gap-3">
                @foreach($tour->images as $image)
                    <div class="position-relative">
                        <img src="{{ asset($image->url) }}" width="140" height="100" class="rounded border">
                    </div>
                @endforeach
            </div>
        </div>

        @for ($i = 0; $i < 5; $i++)
            <div class="mb-3">
                <label for="image-upload-{{ $i }}" class="form-label">Upload Image {{ $i + 1 }}</label>
                <input type="file" name="images[]" class="form-control"
                       accept="image/png, image/jpeg, image/jpg" id="image-upload-{{ $i }}">
            </div>
        @endfor

        <button type="submit" class="btn btn-primary mt-3">Update Tour</button>
    </form>
</div>

@endsection
