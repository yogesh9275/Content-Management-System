@section('title', 'Edit Home Page Element')
@extends('layouts.home')

@section('page')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-4 text-primary">Edit Home Page Element</h3>
                <form action="{{ route('homepage.update', $homePage->id) }}" method="POST" enctype="multipart/form-data"
                    id="edit-form">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="element" class="form-label text-dark fw-bold">Element Type</label>
                        <select class="form-select" name="element" id="element" onchange="toggleDivs()" required>
                            <option value="title" {{ $homePage->element == 'title' ? 'selected' : '' }}>Title</option>
                            <option value="description" {{ $homePage->element == 'description' ? 'selected' : '' }}>
                                Description</option>
                            <option value="image" {{ $homePage->element == 'image' ? 'selected' : '' }}>Image</option>
                            <option value="about-title" {{ $homePage->element == 'about-title' ? 'selected' : '' }}>
                                About-Title</option>
                            <option value="about-description"
                                {{ $homePage->element == 'about-description' ? 'selected' : '' }}>About-Description</option>
                            <option value="about-image" {{ $homePage->element == 'about-image' ? 'selected' : '' }}>
                                About-Image</option>
                            <option value="vision-title" {{ $homePage->element == 'vision-title' ? 'selected' : '' }}>
                                Vision-Title</option>
                            <option value="vision-description"
                                {{ $homePage->element == 'vision-description' ? 'selected' : '' }}>Vision-Description
                            </option>
                            <option value="vision-image" {{ $homePage->element == 'vision-image' ? 'selected' : '' }}>
                                Vision-Image</option>
                        </select>
                    </div>

                    <!-- Div for Title -->
                    <div class="mb-4 element-div" id="title" style="display:none;">
                        <label for="data-title" class="form-label text-dark fw-bold">Title</label>
                        <input type="text" class="form-control" name="data-title" id="data-title"
                            value="{{ $homePage->data }}">
                    </div>

                    <!-- Div for Description -->
                    <div class="mb-4 element-div" id="description" style="display:none;">
                        <label for="data-description" class="form-label text-dark fw-bold">Description</label>
                        <textarea class="form-control" name="data-description" id="data-description" rows="10">{{ $homePage->data }}</textarea>
                        <div id="word-count-error" class="text-danger" style="display: none;">Description exceeds the word
                            limit.
                            Please shorten it.</div>
                        <div id="word-count-display" class="mt-2 text-muted">Words: 0/250</div>
                    </div>

                    <!-- Div for Image -->
                    <div class="mb-4 element-div position-relative" id="image" style="display:none;">
                        <label for="data-image" class="form-label text-dark fw-bold">Upload Image</label>
                        <input type="file" class="form-control" name="data-image" id="data-image" accept="image/*">
                        <span id="cancel-btn" class="position-absolute"
                            style="right: 0.40rem; bottom: 0.40rem; cursor: pointer; display:none;">
                            <x-simpleline-close class="table-icon text-danger" />
                        </span>
                        <div id="file-size-error" class="text-danger mt-2"></div>
                    </div>

                    <!-- Div for About Title -->
                    <div class="mb-4 element-div" id="about-title" style="display:none;">
                        <label for="data-about-title" class="form-label text-dark fw-bold">About Title</label>
                        <input type="text" class="form-control" name="data-about-title" id="data-about-title"
                            value="{{ $homePage->data }}">
                    </div>

                    <!-- Div for About Description -->
                    <div class="mb-4 element-div" id="about-description" style="display:none;">
                        <label for="data-about-description" class="form-label text-dark fw-bold">About Description</label>
                        <textarea class="form-control" name="data-about-description" id="data-about-description" rows="10">{{ $homePage->data }}</textarea>
                        <div id="about-word-count-error" class="text-danger" style="display: none;">Description exceeds the
                            word
                            limit. Please shorten it.</div>
                        <div id="about-word-count-display" class="mt-2 text-muted">Words: 0/250</div>
                    </div>

                    <!-- Div for About Image -->
                    <div class="mb-4 element-div position-relative" id="about-image" style="display:none;">
                        <label for="data-about-image" class="form-label text-dark fw-bold">Upload About Image</label>
                        <input type="file" class="form-control" name="data-about-image" id="data-about-image"
                            accept="image/*">
                        <span id="about-cancel-btn" class="position-absolute"
                            style="right: 0.40rem; bottom: 0.40rem; cursor: pointer; display:none;">
                            <x-simpleline-close class="table-icon text-danger" />
                        </span>
                        <div id="about-file-size-error" class="text-danger mt-2"></div>
                    </div>

                    <!-- Div for Vision Title -->
                    <div class="mb-4 element-div" id="vision-title" style="display:none;">
                        <label for="data-vision-title" class="form-label text-dark fw-bold">Vision Title</label>
                        <input type="text" class="form-control" name="data-vision-title" id="data-vision-title"
                            value="{{ $homePage->data }}">
                    </div>

                    <!-- Div for Vision Description -->
                    <div class="mb-4 element-div" id="vision-description" style="display:none;">
                        <label for="data-vision-description" class="form-label text-dark fw-bold">Vision
                            Description</label>
                        <textarea class="form-control" name="data-vision-description" id="data-vision-description" rows="10">{{ $homePage->data }}</textarea>
                        <div id="vision-word-count-error" class="text-danger" style="display: none;">Description exceeds
                            the word
                            limit. Please shorten it.</div>
                        <div id="vision-word-count-display" class="mt-2 text-muted">Words: 0/250</div>
                    </div>

                    <!-- Div for Vision Image -->
                    <div class="mb-4 element-div position-relative" id="vision-image" style="display:none;">
                        <label for="data-vision-image" class="form-label text-dark fw-bold">Upload Vision Image</label>
                        <input type="file" class="form-control" name="data-vision-image" id="data-vision-image"
                            accept="image/*">
                        <span id="vision-cancel-btn" class="position-absolute"
                            style="right: 0.40rem; bottom: 0.40rem; cursor: pointer; display:none;">
                            <x-simpleline-close class="table-icon text-danger" />
                        </span>
                        <div id="vision-file-size-error" class="text-danger mt-2"></div>
                    </div>

                    <!-- Div for Slider Image -->
                    <div class="mb-4 element-div position-relative" id="slider-image" style="display:none;">
                        <label for="data-slider-image" class="form-label text-dark fw-bold">Upload Slider Image</label>
                        <input type="file" class="form-control" name="data-slider-image" id="data-slider-image"
                            accept="image/*">
                        <span id="slider-cancel-btn" class="position-absolute"
                            style="right: 0.40rem; bottom: 0.40rem; cursor: pointer; display:none;">
                            <x-simpleline-close class="table-icon text-danger" />
                        </span>
                        <div id="slider-file-size-error" class="text-danger mt-2"></div>
                    </div>


                    <!-- Image Preview -->
                    @if (
                        $homePage->element == 'image' ||
                            $homePage->element == 'vision-image' ||
                            $homePage->element == 'about-image' ||
                            $homePage->element == 'slider-image')
                        <div class="mt-3" id="image-preview">
                            <img id="preview-img" src="{{ asset($homePage->data) }}" class="img-thumbnail mb-2"
                                alt="Image Preview" style="max-width: 100%; max-height: 20rem;">
                        </div>
                    @endif

                    <div class="d-flex justify-content-between">
                        <a id="back-btn" href="{{ route('homepage.index') }}" class="btn btn-secondary">Back</a>
                        <button id="update-btn" type="submit" class="btn btn-primary" disabled>Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Function to handle image upload and preview
        function handleImageUpload(fileInputId, cancelBtnID, previewImgId, errorId, originalImageSrc) {
            var fileInput = document.getElementById(fileInputId);
            var cancelBtn = document.getElementById(cancelBtnID);
            var previewImg = document.getElementById(previewImgId);
            var fileSizeError = document.getElementById(errorId);

            // Store the original image source
            const originalImage = originalImageSrc;

            // When a file is selected, show preview
            fileInput.addEventListener('change', function(event) {
                var file = event.target.files[0];
                var reader = new FileReader();

                reader.onload = function(e) {
                    if (file && file.size <= 2 * 1024 * 1024) { // Check if file size is within 2MB
                        previewImg.src = e.target.result; // Set image source to the selected file
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
                        previewImg.src = ''; // Clear image source
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
                previewImg.src = originalImage; // Clear image source
                cancelBtn.style.display = 'none'; // Hide cancel button
            });
        }

        // Initialize event listeners for image uploads and word counts dynamically
        document.addEventListener('DOMContentLoaded', function () {
            const originalImageSrc = document.getElementById('preview-img').src || '';

            // Toggle visibility and setup functions on page load
            toggleDivs(); // Call the toggle function to show correct section

            // Call specific functions when certain section is visible
            document.getElementById('element').addEventListener('change', toggleDivs); // Event listener for dropdown changes

            // Function to toggle visibility of element-specific sections
            function toggleDivs() {
                const selectedElement = document.getElementById('element').value; // Selected element
                const elementDivs = document.querySelectorAll('.element-div');

                elementDivs.forEach(function (div) {
                    if (div.id === selectedElement) {
                        div.style.display = 'block';
                        initializeSectionFunctions(selectedElement); // Initialize functions for visible section
                    } else {
                        div.style.display = 'none';
                    }
                });
            }

            // Function to initialize specific section based on the selected element
            function initializeSectionFunctions(selectedElement) {
                switch (selectedElement) {
                    case 'data-about-image':
                        handleImageUpload('data-about-image', 'about-cancel-btn', 'preview-img', 'about-file-size-error', originalImageSrc);
                        break;
                    case 'data-vision-image':
                        handleImageUpload('data-vision-image', 'vision-cancel-btn', 'preview-img', 'vision-file-size-error', originalImageSrc);
                        break;
                    case 'data-slider-image':
                        handleImageUpload('data-slider-image', 'slider-cancel-btn', 'preview-img', 'slider-file-size-error', originalImageSrc);
                        break;
                    case 'data-image':
                        handleImageUpload('data-image', 'cancel-btn', 'preview-img', 'about-file-size-error', originalImageSrc);
                        break;
                    case 'data-description':
                        updateWordCount('data-description', 'word-count-display', 'word-count-error', 250);
                        break;
                    case 'data-about-description':
                        updateWordCount('data-about-description', 'about-word-count-display', 'about-word-count-error', 250);
                        break;
                    case 'data-vision-description':
                        updateWordCount('data-vision-description', 'vision-word-count-display', 'vision-word-count-error', 250);
                        break;
                    default:
                        console.warn(`No handler defined for: ${selectedElement}`);
                }
            }
        });

        // Word count function
        function countWords(text) {
            return text.split(/\s+/).filter(Boolean).length;
        }

        // Update word count and button state
        function updateWordCount(textareaId, displayId, errorId, maxWords) {
            const textarea = document.getElementById(textareaId);
            const wordCountDisplay = document.getElementById(displayId);
            const wordCountError = document.getElementById(errorId);
            const submitButton = document.getElementById('update-btn');

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
