@section('title', 'Edit Image')
@extends('layouts.home')

@section('page')
    <div class="container mt-5">
        <h3 class="text-center mb-4">Edit Image</h3>

        <form action="{{ route('galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Category Select Dropdown -->
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select name="category" id="category" class="form-select" required>
                    <option value="News" {{ $gallery->category == 'News' ? 'selected' : '' }}>News</option>
                    <option value="Celebrations" {{ $gallery->category == 'Celebrations' ? 'selected' : '' }}>Celebrations</option>
                    <option value="Religional" {{ $gallery->category == 'Religional' ? 'selected' : '' }}>Religional</option>
                    <option value="Promotion" {{ $gallery->category == 'Promotion' ? 'selected' : '' }}>Promotion</option>
                </select>
            </div>

            <!-- Re-upload Image -->
            <div class="mb-3 position-relative">
                <label for="path" class="form-label">Re-upload Image</label>
                <input type="file" name="path" id="path" class="form-control" accept="image/*">
                <!-- X button inside the input field, hidden by default -->
                <span id="cancel-btn" class="position-absolute" style="right: 0.40rem; bottom: 0.40rem; cursor: pointer; display:none;"><x-simpleline-close class="table-icon text-danger"/></span>
            </div>

            <!-- Display current image in Flexbox Layout -->
            <div class="mb-3" style="display: flex; flex-direction: column; align-items: center;">
                <label for="current-image" class="form-label">Current Image</label>
                <img src="{{ asset($gallery->path) }}" alt="Gallery Image" class="img-thumbnail" id="current-image" style="max-width: 100%; height: auto;">
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between">
                <aid="back-btn" href="{{ route('galleries.index') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-warning">Update Image</button>
            </div>
        </form>
    </div>

    <script>
        // Save the original image path on page load
        var originalImageSrc = '{{ asset($gallery->path) }}';
        var image = document.getElementById('current-image');
        var cancelBtn = document.getElementById('cancel-btn');
        var fileInput = document.getElementById('path');

        // Event listener to change the image preview when a new file is selected
        fileInput.addEventListener('change', function(event) {
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                image.src = e.target.result; // Update the image source to the new uploaded file
                cancelBtn.style.display = 'inline-block'; // Show the cancel button
            };

            if (file) {
                reader.readAsDataURL(file); // Read and load the selected file
            }
        });

        // Event listener for the cancel button to clear the input and restore the original image
        cancelBtn.addEventListener('click', function() {
            fileInput.value = ''; // Clear the file input
            image.src = originalImageSrc; // Restore the original image
            cancelBtn.style.display = 'none'; // Hide the cancel button
        });
    </script>
@endsection
