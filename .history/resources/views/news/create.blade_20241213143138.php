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
        function toggleDivs() {
            var selectedElement = document.getElementById("element").value;
            var allDivs = document.querySelectorAll(".element-div");
            allDivs.forEach(function(div) {
                div.style.display = "none";
            });
            if (selectedElement) {
                var selectedDiv = document.getElementById(selectedElement);
                if (selectedDiv) {
                    selectedDiv.style.display = "block";
                }
            }
        }

        // Image upload logic with preview and cancel button
        const imageInput = document.getElementById("data-image");
        const imagePreview = document.getElementById("image-preview");
        const previewImg = document.getElementById("preview-img");
        const cancelBtn = document.getElementById("cancel-btn");
        const fileSizeError = document.getElementById("file-size-error");

        // Save the original image path (can be set on page load for editing)
        var originalImageSrc = '{{ $element->element == 'Image' && $element->data ? asset($element->data) : asset('images/default-image.png') }}';
        previewImg.src = originalImageSrc;  // Set default preview image

        imageInput.addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const fileSize = file.size / 1024 / 1024; // Convert file size to MB
                const maxSize = 2; // Max file size (2MB)

                if (fileSize > maxSize) {
                    fileSizeError.textContent = "File size exceeds 2MB. Please upload a smaller image.";
                    imageInput.value = "";
                    imagePreview.style.display = "none";
                    cancelBtn.style.display = "none";
                    return;
                }

                fileSizeError.textContent = "";  // Clear any file size error

                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;  // Update the preview image source
                    imagePreview.style.display = "block";  // Show the image preview
                    cancelBtn.style.display = "inline-block";  // Show cancel button
                };
                reader.readAsDataURL(file);  // Read and display the selected file
            }
        });

        // Event listener for the cancel button to reset the file input and restore the original image
        cancelBtn.addEventListener("click", function() {
            imageInput.value = "";  // Clear the image input
            imagePreview.style.display = "none";  // Hide the preview
            cancelBtn.style.display = "none";  // Hide the cancel button
            previewImg.src = originalImageSrc;  // Restore the original image
        });

        // Initialize the view when the page loads
        window.onload = toggleDivs;
    </script>


@endsection
