<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Image</title>
</head>
<body>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if($errors->any())
    <ul style="color: red;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('image.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Select Image:</label>
    <input type="file" name="image" required><br><br>

    <input type="hidden" name="imageable_id" value="5">
    <input type="hidden" name="imageable_type" value="App\Models\Tour">

    <button type="submit">Upload Image</button>
</form>

<hr>

<h3>Uploaded Images</h3>
<ul>
@foreach($images as $image)
    <li>
        <img src="{{ asset($image->url) }}" alt="Image" width="100">
        <form action="{{ route('image.delete', $image->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </li>
@endforeach
</ul>

</body>
</html>
