@section('title', 'Add News')
@extends('layouts.home')

@section('page')
    <div class="container mt-4">
        <h1 class="mb-4">Create News</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control">
                <!-- X button inside the input field, hidden by default -->
                <span id="cancel-btn" class="position-absolute"
                    style="right: 0.40rem; bottom: 0.40rem; cursor: pointer; display:none;">
                    <x-simpleline-close class="table-icon text-danger" />
                </span>

                <!-- Error message for file size -->
                <div id="file-size-error" class="text-danger mt-2"></div>
            </div>

            <!-- Image preview -->
            <div class="mt-3" id="image-preview"
                style="display: none">
                <img id="imagePreview" src="#" alt="Image Preview" class="img-thumbnail mb-2" alt="Image Preview"
                    style="max-width: 100%; max-height: 100%;">
            </div>

            <div class="mb-3">
                <div class="form-label">Details</div>
                <div id="editor">
                    <div id="edit">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a id="back-btn" href="{{ route('news.index') }}" class="btn btn-secondary">Back</a>
                <button id="create-btn" type="submit" class="btn btn-primary">Create News</button>
            </div>

        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Save the original image path on page load (using a default image as a placeholder)
            var originalImageSrc = '{{ $element->element == 'Image' && $element->data ? asset($element->data) : asset('images/default-image.png') }}';
            var imagePreview = document.getElementById('imagePreview');
            var cancelBtn = document.getElementById('cancel-btn');
            var imageInput = document.getElementById('image');
            var fileSizeError = document.getElementById("file-size-error");

            // Event listener for the image input to handle file selection and display the preview
            imageInput.addEventListener('change', function(event) {
                var file = event.target.files[0];
                var reader = new FileReader();

                if (file) {
                    // Validate file size
                    const fileSize = file.size / 1024 / 1024; // Convert bytes to MB
                    const maxSize = 2; // 2MB max file size

                    if (fileSize > maxSize) {
                        fileSizeError.textContent = "File size exceeds 2MB. Please upload a smaller image.";
                        imageInput.value = ''; // Clear input
                        imagePreview.src = originalImageSrc; // Restore the original image if size exceeds
                        cancelBtn.style.display = 'none'; // Hide cancel button
                        return;
                    }

                    fileSizeError.textContent = ''; // Clear any file size error message
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result; // Set preview image
                        cancelBtn.style.display = 'inline-block'; // Show cancel button
                    };
                    reader.readAsDataURL(file); // Read the selected file
                }
            });

            // Event listener for the cancel button to clear the image input and restore the original image
            cancelBtn.addEventListener('click', function() {
                imageInput.value = ''; // Clear the file input
                imagePreview.src = originalImageSrc; // Restore the original image
                cancelBtn.style.display = 'none'; // Hide the cancel button
            });

            // Image preview will show the original image by default on page load
            imagePreview.src = originalImageSrc;

            // Dynamic textarea height (existing code)
            const detailsTextarea = document.getElementById('details');
            detailsTextarea.addEventListener('input', function() {
                this.style.height = 'auto'; // Reset height to auto
                const scrollHeight = this.scrollHeight;
                const maxHeight = 25 * parseFloat(getComputedStyle(this).lineHeight); // Max rows 25
                if (scrollHeight < maxHeight) {
                    this.style.height = scrollHeight + 'px'; // Adjust to fit content
                } else {
                    this.style.height = maxHeight + 'px'; // Set to max height
                }
            });
        });
    </script>

@endsection
