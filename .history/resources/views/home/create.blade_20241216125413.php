@section('title', 'Add Home Page Element')
@extends('layouts.home')

@section('page')
    <div class="container mt-5">
        <h3 class="mb-4 text-primary">Add Home Page Element</h3>
        <form action="{{ route('homepage.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="element" class="form-label text-dark fw-bold">Element Type</label>
                <select class="form-select" name="element" id="element" onchange="toggleDivs()" required>
                    <option value="" disabled selected>Select an element</option>
                    <option value="Title">Title</option>
                    <option value="Description">Description</option>
                    <option value="Image">Image</option>
                    <option value="About-Title">About-Title</option>
                    <option value="About-Description">About-Description</option>
                    <option value="About-Image">About-Image</option>
                </select>
            </div>

            <!-- Div for Title -->
            <div class="mb-4 element-div" id="Title" style="display:none;">
                <label for="data-title" class="form-label text-dark fw-bold">Title</label>
                <input type="text" class="form-control" name="data-title" id="data-title">
            </div>

            <!-- Div for Description -->
            <div class="mb-4 element-div" id="Description" style="display:none;">
                <label for="data-description" class="form-label text-dark fw-bold">Description</label>
                <textarea class="form-control" name="data-description" id="data-description" rows="10"></textarea>
                <div id="word-count-error" class="text-danger" style="display: none;">Description exceeds the word limit.
                    Please shorten it.</div>
                <div id="word-count-display" class="mt-2 text-muted">Words: 0/250</div>
            </div>

            <!-- Div for Image -->
            <div class="mb-4 element-div position-relative" id="Image" style="display:none;">
                <label for="data-image" class="form-label text-dark fw-bold">Upload Image</label>
                <input type="file" class="form-control" name="data-image" id="data-image" accept="image/*">
                <span id="cancel-btn" class="position-absolute"
                    style="right: 0.40rem; bottom: 0.40rem; cursor: pointer; display:none;">
                    <x-simpleline-close class="table-icon text-danger" />
                </span>
                <div id="file-size-error" class="text-danger mt-2"></div>
            </div>

            <!-- Div for About Title -->
            <div class="mb-4 element-div" id="About-Title" style="display:none;">
                <label for="data-about-title" class="form-label text-dark fw-bold">About Title</label>
                <input type="text" class="form-control" name="data-about-title" id="data-about-title">
            </div>

            <!-- Div for About Description -->
            <div class="mb-4 element-div" id="About-Description" style="display:none;">
                <label for="data-about-description" class="form-label text-dark fw-bold">About Description</label>
                <textarea class="form-control" name="data-about-description" id="data-about-description" rows="10"></textarea>
                <div id="about-word-count-error" class="text-danger" style="display: none;">Description exceeds the word
                    limit. Please shorten it.</div>
                <div id="about-word-count-display" class="mt-2 text-muted">Words: 0/250</div>
            </div>

            <!-- Div for About Image -->
            <div class="mb-4 element-div position-relative" id="About-Image" style="display:none;">
                <label for="data-about-image" class="form-label text-dark fw-bold">Upload About Image</label>
                <input type="file" class="form-control" name="data-about-image" id="data-about-image" accept="image/*">
                <span id="about-cancel-btn" class="position-absolute"
                    style="right: 0.40rem; bottom: 0.40rem; cursor: pointer; display:none;">
                    <x-simpleline-close class="table-icon text-danger" />
                </span>
                <div id="about-file-size-error" class="text-danger mt-2"></div>
            </div>

            <!-- Image Preview -->
            <div class="mt-3" id="image-preview" style="display: none;">
                <img id="preview-img" src="" class="img-thumbnail mb-2" alt="Image Preview"
                    style="max-width: 100%; max-height: 20rem;">
            </div>

            <div class="d-flex justify-content-between">
                <a id="back-btn" href="{{ route('homepage.index') }}" class="btn btn-secondary">Back</a>
                <button id="create-btn" type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>

    <script>
        // Handle file upload and preview for both About Image and regular Image
        var image = document.getElementById('preview-img');
        var cancelBtn = document.getElementById('cancel-btn');
        var fileSizeError = document.getElementById("about-file-size-error");

        // Function to handle image upload and preview
        function handleImageUpload(fileInputId) {
            var fileInput = document.getElementById(fileInputId);

            // When a file is selected, show preview
            fileInput.addEventListener('change', function(event) {
                var file = event.target.files[0];
                var reader = new FileReader();

                reader.onload = function(e) {
                    if (file && file.size <= 2 * 1024 * 1024) { // Check if file size is within 2MB
                        image.src = e.target.result; // Set image source to the selected file
                        cancelBtn.style.display = 'inline-block'; // Show cancel button
                        document.getElementById('image-preview').style.display = 'block'; // Show image preview container
                        fileSizeError.textContent = ''; // Clear any file size error
                    }
                };

                if (file) {
                    const fileSize = file.size / 1024 / 1024; // Convert bytes to MB
                    const maxSize = 2; // Max 2MB
                    if (fileSize > maxSize) {
                        fileSizeError.textContent = "File size exceeds 2MB. Please upload a smaller image."; // Display error
                        fileInput.value = ''; // Clear input
                        image.src = ''; // Clear image source
                        cancelBtn.style.display = 'none'; // Hide cancel button
                        document.getElementById('image-preview').style.display = 'none'; // Hide preview container
                        return;
                    }
                    fileSizeError.textContent = ''; // Clear file size error
                    reader.readAsDataURL(file); // Preview image
                }
            });

            // Logic for cancel button to clear file input and hide preview
            cancelBtn.addEventListener('click', function() {
                fileInput.value = ''; // Clear file input
                image.src = ''; // Clear image source
                cancelBtn.style.display = 'none'; // Hide cancel button
                document.getElementById('image-preview').style.display = 'none'; // Hide image preview container
            });
        }

        // Initialize event listeners for both About Image and Regular Image inputs
        document.addEventListener('DOMContentLoaded', function() {
            handleImageUpload('data-about-image', 'cancel-btn'); // Handle About Image
            handleImageUpload('data-image', 'about-cancel-btn'); // Handle Regular Image

            // Toggle visibility and set up other element-specific logic
            toggleDivs();

            // Regular description
            updateWordCount('data-description', 'word-count-display', 'word-count-error', 250);

            // Update word count and handle error for About Description
            updateWordCount('data-about-description', 'about-word-count-display', 'about-word-count-error', 250);
        });

        // Toggle visibility of element-specific sections
        function toggleDivs() {
            const selectedElement = document.getElementById('element').value;
            const elementDivs = document.querySelectorAll('.element-div');
            elementDivs.forEach(function(div) {
                div.style.display = div.id === selectedElement ? 'block' : 'none';
            });
        }

        // Word count function
        function countWords(text) {
            return text.split(/\s+/).filter(Boolean).length;
        }

        // Update word count and button state
        function updateWordCount(textareaId, displayId, errorId, maxWords) {
            const textarea = document.getElementById(textareaId);
            const wordCountDisplay = document.getElementById(displayId);
            const wordCountError = document.getElementById(errorId);
            const submitButton = document.getElementById('create-btn');

            // Function to update the word count
            function handleWordCount() {
                var wordCount = countWords(textarea.value);
                wordCountDisplay.textContent = `Words: ${wordCount}/${maxWords}`;

                // Disable submit button if word count exceeds max
                if (wordCount > maxWords) {
                    submitButton.disabled = true;
                    wordCountError.style.display = 'block';
                } else {
                    submitButton.disabled = false;
                    wordCountError.style.display = 'none';
                }
            }

            // Initialize word count display when page loads
            handleWordCount();

            // Listen for input events to update the word count and button status dynamically
            textarea.addEventListener('input', handleWordCount);
        }
    </script>
@endsection
