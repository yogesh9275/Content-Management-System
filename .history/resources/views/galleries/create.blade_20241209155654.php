@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h3>Add New Image</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data" id="imageForm">
                @csrf

                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select name="category" id="category" class="form-select" required>
                        <option value="" disabled selected>Select a category</option>
                        <option value="Category1">Category 1</option>
                        <option value="Category2">Category 2</option>
                        <option value="Category3">Category 3</option>
                        <option value="Category4">Category 4</option>
                    </select>
                </div>


                <div class="mb-3">
                    <label for="path" class="form-label">Upload Image</label>
                    <input type="file" name="path" id="path" class="form-control" accept="image/*" required>
                    <div id="error-message" class="text-danger mt-2" style="display:none;">File size must be less than 2MB.</div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('galleries.index') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-success">Add Image</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
@endsection
