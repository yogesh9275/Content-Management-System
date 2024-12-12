@yield('title', 'Gallery Management')

@extends('layouts.home')

@section('page')
<script>
    // Function to check file size and display error message
    function checkFileSize() {
        var fileInput = document.getElementById('path');
        var errorMessage = document.getElementById('error-message');

        // Check if file is selected
        if (fileInput.files.length > 0) {
            var fileSize = fileInput.files[0].size / 1024 / 1024; // Convert bytes to MB

            // If the file size is greater than 2MB
            if (fileSize > 2) {
                errorMessage.style.display = 'block'; // Show the error message
                fileInput.setCustomValidity('File size must be less than 2MB');

                // Clear the file input
                fileInput.value = '';  // This will reset the file input field
            } else {
                errorMessage.style.display = 'none'; // Hide the error message
                fileInput.setCustomValidity(''); // Reset any custom validation message
            }
        }
    }

    // Add event listener to trigger file size check when file is selected
    document.getElementById('path').addEventListener('change', checkFileSize);
</script>

<div class="container mt-5">
    <h3 class="mb-4 text-primary">Add New Image</h3>
    <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data" id="imageForm">
        @csrf

        <div class="mb-4">
            <label for="category" class="form-label">Category</label>
            <select name="category" id="category" class="form-select" required>
                <option value="" disabled selected>Select a category</option>
                <option value="News">News</option>
                <option value="Celebrations">Celebrations</option>
                <option value="Religional">Religional</option>
                <option value="Promotion">Promotion</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="path" class="form-label">Upload Image</label>
            <input type="file" name="path" id="path" class="form-control" accept="image/*" required>
            <div id="error-message" class="text-danger mt-2" style="display:none;">File size must be less than 2MB.</div>
        </div>

        <!-- Display the uploaded image preview below the image input field -->
        <div class="mb-4" id="image-preview" style="display:none;flex-direction: column;">
            <label class="form-label">Uploaded Image</label>
            <img id="uploaded-image" src="" alt="Uploaded Image" class="img-fluid">
        </div>


        <div class="d-flex justify-content-between">
            <a href="{{ route('galleries.index') }}" class="btn btn-secondary">Back</a>
            <button type="submit" class="btn btn-success">Add Image</button>
        </div>
    </form>
</div>

<script>
    // Display the uploaded image preview
    document.getElementById('path').addEventListener('change', function (event) {
        var file = event.target.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            var imagePreview = document.getElementById('image-preview');
            var uploadedImage = document.getElementById('uploaded-image');
            uploadedImage.src = e.target.result;
            imagePreview.style.display = 'flex'; // Show the preview
        };

        // Check if a file is selected
        if (file) {
            reader.readAsDataURL(file); // Display image as a preview
        }
    });
</script>

@endsection
