@extends('layouts.navigationadmin')

@section('content')
    <div class="container mt-5">
        <h1>Create New Tour</h1>
        <form action="{{ route('admin.tours.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="start" class="form-label">Start Date</label>
                <input type="date" name="start" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="end" class="form-label">End Date</label>
                <input type="date" name="end" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="places" class="form-label">Places</label>
                <input type="number" name="places" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <select name="city" class="form-control" required>
                    <option value="">Select City</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->name }}">{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select name="country" class="form-control" required>
                    <option value="">Select Country</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="tag" class="form-label">Tag</label>
                <select name="tag" class="form-control" required>
                    <option value="">Select Tag</option>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Image Upload Section -->
<div class="mb-3">
    <label for="image-upload-1" class="form-label">Upload Image 1</label>
    <input type="file" name="images[]" class="form-control" multiple accept="image/png, image/jpeg, image/jpg" id="image-upload-1">
</div>
<div class="mb-3">
    <label for="image-upload-2" class="form-label">Upload Image 2</label>
    <input type="file" name="images[]" class="form-control" multiple accept="image/png, image/jpeg, image/jpg" id="image-upload-2">
</div>
<div class="mb-3">
    <label for="image-upload-3" class="form-label">Upload Image 3</label>
    <input type="file" name="images[]" class="form-control" multiple accept="image/png, image/jpeg, image/jpg" id="image-upload-3">
</div>
<div class="mb-3">
    <label for="image-upload-4" class="form-label">Upload Image 4</label>
    <input type="file" name="images[]" class="form-control" multiple accept="image/png, image/jpeg, image/jpg" id="image-upload-4">
</div>
<div class="mb-3">
    <label for="image-upload-5" class="form-label">Upload Image 5</label>
    <input type="file" name="images[]" class="form-control" multiple accept="image/png, image/jpeg, image/jpg" id="image-upload-5">
</div>

<!-- Preview Section -->
<div id="image-preview" class="mb-3">
    <!-- Images will be previewed here -->
</div>

<button type="submit" class="btn btn-primary">Create Tour</button>

<script>
    // Function to handle image preview for each input
    function handleImagePreview(fileInputId) {
        const fileInput = document.getElementById(fileInputId);
        const previewContainer = document.getElementById('image-preview');

        // Listen for the change event when files are selected
        fileInput.addEventListener('change', function(event) {
            // Loop through selected files
            Array.from(event.target.files).forEach((file) => {
                const reader = new FileReader();

                // Read the file as a data URL
                reader.onload = function(e) {
                    const imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    imgElement.alt = 'Preview';
                    imgElement.classList.add('img-thumbnail');
                    imgElement.style.width = '150px';
                    imgElement.style.marginRight = '10px';

                    // Create a delete button for each preview
                    const deleteButton = document.createElement('button');
                    deleteButton.textContent = 'Delete';
                    deleteButton.classList.add('btn', 'btn-danger', 'btn-sm');
                    deleteButton.style.marginTop = '5px';

                    // Add click event to remove image preview
                    deleteButton.addEventListener('click', function() {
                        imgElement.remove();
                        deleteButton.remove();
                    });

                    // Append the image and delete button to the preview container
                    previewContainer.appendChild(imgElement);
                    previewContainer.appendChild(deleteButton);
                };

                // Read the file
                reader.readAsDataURL(file);
            });
        });
    }

    // Call the preview function for each input field
    handleImagePreview('image-upload-1');
    handleImagePreview('image-upload-2');
    handleImagePreview('image-upload-3');
    handleImagePreview('image-upload-4');
    handleImagePreview('image-upload-5');
</script>
@endsection

