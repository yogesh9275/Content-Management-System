@section('title', 'Edit Home Page Element')
@extends('layouts.home')

@section('page')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-4 text-primary">Edit Home Page Element</h3>
                <form action="{{ route('homepage.update', $homePage->id) }}" method="POST" enctype="multipart/form-data" id="edit-form">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="element" class="form-label text-dark fw-bold">Element Type</label>
                        <select class="form-select" name="element" id="element" onchange="toggleDivs()" required>
                            <option value="title" {{ $homePage->element == 'title' ? 'selected' : '' }}>Title</option>
                            <option value="description" {{ $homePage->element == 'description' ? 'selected' : '' }}>Description</option>
                            <option value="image" {{ $homePage->element == 'image' ? 'selected' : '' }}>Image</option>
                            <option value="about-title" {{ $homePage->element == 'about-title' ? 'selected' : '' }}>About-Title</option>
                            <option value="about-description" {{ $homePage->element == 'about-description' ? 'selected' : '' }}>About-Description</option>
                            <option value="about-image" {{ $homePage->element == 'about-image' ? 'selected' : '' }}>About-Image</option>
                            <option value="vision-title" {{ $homePage->element == 'vision-title' ? 'selected' : '' }}>Vision-Title</option>
                            <option value="vision-description" {{ $homePage->element == 'vision-description' ? 'selected' : '' }}>Vision-Description</option>
                            <option value="vision-image" {{ $homePage->element == 'vision-image' ? 'selected' : '' }}>Vision-Image</option>
                        </select>
                    </div>

                    <!-- Div for Title -->
                    <div class="mb-4 element-div" id="title" style="display: {{ $homePage->element == 'title' ? 'block' : 'none' }}">
                        <label for="data-title" class="form-label text-dark fw-bold">Title Data</label>
                        <input type="text" class="form-control" name="data-title" id="data-title" value="{{ $homePage->data }}">
                    </div>

                    <!-- Div for Description -->
                    <div class="mb-4 element-div" id="description" style="display: {{ $homePage->element == 'description' ? 'block' : 'none' }}">
                        <label for="data-description" class="form-label text-dark fw-bold">Description Data</label>
                        <textarea class="form-control" name="data-description" id="data-description" rows="10">{{ $homePage->data }}</textarea>
                        <div id="word-count-error" class="text-danger" style="display: none;">Description exceeds the word limit. Please shorten it.</div>
                        <div id="word-count-display" class="mt-2 text-muted">Words: 0/150</div>
                    </div>

                    <!-- Div for Image -->
                    <div class="mb-4 element-div position-relative" id="image" style="display: {{ $homePage->element == 'image' && $homePage->data ? 'block' : 'none' }};">
                        <label for="data-image" class="form-label text-dark fw-bold">Upload Image</label>
                        <input type="file" class="form-control" name="data-image" id="data-image" accept="image/*">
                        <span id="cancel-btn" class="position-absolute" style="right: 0.40rem; bottom: 0.40rem; cursor: pointer; display:none;">
                            <x-simpleline-close class="table-icon text-danger" />
                        </span>
                        <div id="file-size-error" class="text-danger mt-2"></div>
                    </div>

                    <!-- Image Preview -->
                    <div class="mt-3" id="image-preview" style="display: {{ $homePage->element == 'image' && $homePage->data ? 'block' : 'none' }};">
                        <img id="preview-img" src="{{ $homePage->element == 'Image' && $homePage->data ? asset($homePage->data) : '' }}" class="img-thumbnail mb-2" alt="Image Preview" style="max-width: 100%; max-height: 100%;">
                    </div>

                    <!-- Div for About Title -->
                    <div class="mb-4 element-div" id="about-title" style="display: {{ $homePage->element == 'about-title' ? 'block' : 'none' }}">
                        <label for="data-about-title" class="form-label text-dark fw-bold">About Title Data</label>
                        <input type="text" class="form-control" name="data-about-title" id="data-about-title" value="{{ $homePage->data }}">
                    </div>

                    <!-- Div for About Description -->
                    <div class="mb-4 element-div" id="about-description" style="display: {{ $homePage->element == 'about-description' ? 'block' : 'none' }}">
                        <label for="data-about-description" class="form-label text-dark fw-bold">About Description Data</label>
                        <textarea class="form-control" name="data-about-description" id="data-about-description" rows="10">{{ $homePage->data }}</textarea>
                        <div id="about-word-count-error" class="text-danger" style="display: none;">Description exceeds the word limit. Please shorten it.</div>
                        <div id="about-word-count-display" class="mt-2 text-muted">Words: 0/150</div>
                    </div>

                    <!-- Div for About Image -->
                    <div class="mb-4 element-div position-relative" id="about-image" style="display: {{ $homePage->element == 'about-image' && $homePage->data ? 'block' : 'none' }};">
                        <label for="data-about-image" class="form-label text-dark fw-bold">Upload About Image</label>
                        <input type="file" class="form-control" name="data-about-image" id="data-about-image" accept="image/*">
                        <span id="cancel-about-btn" class="position-absolute" style="right: 0.40rem; bottom: 0.40rem; cursor: pointer; display:none;">
                            <x-simpleline-close class="table-icon text-danger" />
                        </span>
                        <div id="about-file-size-error" class="text-danger mt-2"></div>
                    </div>

                    <!-- About Image Preview -->
                    <div class="mt-3" id="about-image-preview" style="display: {{ $homePage->element == 'about-image' && $homePage->data ? 'block' : 'none' }};">
                        <img id="about-preview-img" src="{{ $homePage->element == 'About-Image' && $homePage->data ? asset($homePage->data) : '' }}" class="img-thumbnail mb-2" alt="Image Preview" style="max-width: 100%; max-height: 100%;">
                    </div>

                    <input type="hidden" name="data-long-text" id="data-long-text">


                    <!-- Div for vision Title -->
                    <div class="mb-4 element-div" id="about-title" style="display: {{ $homePage->element == 'about-title' ? 'block' : 'none' }}">
                        <label for="data-about-title" class="form-label text-dark fw-bold">About Title Data</label>
                        <input type="text" class="form-control" name="data-about-title" id="data-about-title" value="{{ $homePage->data }}">
                    </div>

                    <!-- Div for About Description -->
                    <div class="mb-4 element-div" id="about-description" style="display: {{ $homePage->element == 'about-description' ? 'block' : 'none' }}">
                        <label for="data-about-description" class="form-label text-dark fw-bold">About Description Data</label>
                        <textarea class="form-control" name="data-about-description" id="data-about-description" rows="10">{{ $homePage->data }}</textarea>
                        <div id="about-word-count-error" class="text-danger" style="display: none;">Description exceeds the word limit. Please shorten it.</div>
                        <div id="about-word-count-display" class="mt-2 text-muted">Words: 0/150</div>
                    </div>

                    <!-- Div for About Image -->
                    <div class="mb-4 element-div position-relative" id="about-image" style="display: {{ $homePage->element == 'about-image' && $homePage->data ? 'block' : 'none' }};">
                        <label for="data-about-image" class="form-label text-dark fw-bold">Upload About Image</label>
                        <input type="file" class="form-control" name="data-about-image" id="data-about-image" accept="image/*">
                        <span id="cancel-about-btn" class="position-absolute" style="right: 0.40rem; bottom: 0.40rem; cursor: pointer; display:none;">
                            <x-simpleline-close class="table-icon text-danger" />
                        </span>
                        <div id="about-file-size-error" class="text-danger mt-2"></div>
                    </div>

                    <!-- About Image Preview -->
                    <div class="mt-3" id="about-image-preview" style="display: {{ $homePage->element == 'about-image' && $homePage->data ? 'block' : 'none' }};">
                        <img id="about-preview-img" src="{{ $homePage->element == 'About-Image' && $homePage->data ? asset($homePage->data) : '' }}" class="img-thumbnail mb-2" alt="Image Preview" style="max-width: 100%; max-height: 100%;">
                    </div>

                    <input type="hidden" name="data-long-text" id="data-long-text">

                    <div class="d-flex justify-content-between">
                        <a id="back-btn" href="{{ route('homepage.index') }}" class="btn btn-secondary">Back</a>
                        <button id="update-btn" type="submit" class="btn btn-primary" disabled>Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Handle file upload and preview for both about image and regular image
        var originalImageSrc = '{{ $homePage->element == 'Image' && $homePage->data ? asset($homePage->data) : asset('images/default-image.png') }}';
        var aboutOriginalImageSrc = '{{ $homePage->element == 'About-Image' && $homePage->data ? asset($homePage->data) : asset('images/default-image.png') }}';
        var image = document.getElementById('preview-img');
        var aboutImage = document.getElementById('about-preview-img');
        var cancelBtn = document.getElementById('cancel-btn');
        var cancelAboutBtn = document.getElementById('cancel-about-btn');
        var fileInput = document.getElementById('data-image');
        var aboutFileInput = document.getElementById('data-about-image');
        var fileSizeError = document.getElementById("file-size-error");
        var aboutFileSizeError = document.getElementById("about-file-size-error");

        // Handle file upload for regular image
        fileInput.addEventListener('change', function(event) {
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                image.src = e.target.result;
                cancelBtn.style.display = 'inline-block';
            };

            if (file) {
                const fileSize = file.size / 1024 / 1024; // Convert bytes to MB
                const maxSize = 2; // Max 2MB
                if (fileSize > maxSize) {
                    fileSizeError.textContent = "File size exceeds 2MB. Please upload a smaller image.";
                    fileInput.value = ''; // Clear input
                    image.src = originalImageSrc; // Restore original image if size exceeds
                    cancelBtn.style.display = 'none';
                    return;
                }
                fileSizeError.textContent = '';
                reader.readAsDataURL(file);
            }
        });

        cancelBtn.addEventListener('click', function() {
            fileInput.value = ''; // Clear file input
            image.src = originalImageSrc; // Restore original image
            cancelBtn.style.display = 'none'; // Hide cancel button
        });

        // Handle file upload for About Image
        aboutFileInput.addEventListener('change', function(event) {
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                aboutImage.src = e.target.result;
                cancelAboutBtn.style.display = 'inline-block';
            };

            if (file) {
                const fileSize = file.size / 1024 / 1024; // Convert bytes to MB
                const maxSize = 2; // Max 2MB
                if (fileSize > maxSize) {
                    aboutFileSizeError.textContent = "File size exceeds 2MB. Please upload a smaller image.";
                    aboutFileInput.value = ''; // Clear input
                    aboutImage.src = aboutOriginalImageSrc; // Restore original image if size exceeds
                    cancelAboutBtn.style.display = 'none';
                    return;
                }
                aboutFileSizeError.textContent = '';
                reader.readAsDataURL(file);
            }
        });

        cancelAboutBtn.addEventListener('click', function() {
            aboutFileInput.value = ''; // Clear file input
            aboutImage.src = aboutOriginalImageSrc; // Restore original image
            cancelAboutBtn.style.display = 'none'; // Hide cancel button
        });

        // Toggle visibility of element-specific sections
        function toggleDivs() {
            const selectedElement = document.getElementById('element').value;
            const elementDivs = document.querySelectorAll('.element-div');
            elementDivs.forEach(function(div) {
                div.style.display = div.id === selectedElement ? 'block' : 'none';
            });
        }

        // Set initial state based on the selected element
        document.addEventListener('DOMContentLoaded', function() {
            toggleDivs();
            updateWordCount();
        });

        // Function to count words, including initial content in the textarea
        function countWords(text) {
            return text.split(/\s+/).filter(Boolean).length; // Count words
        }

        // Word count check for the description textarea
        document.getElementById('data-description').addEventListener('input', function() {
            updateWordCount(); // Update word count on input
        });

        // Function to update word count and button state
        function updateWordCount() {
            var descriptionTextarea = document.getElementById('data-description');
            var wordCount = countWords(descriptionTextarea.value); // Count words in current text
            var maxWords = 200; // Maximum words allowed

            // Display the word count inside the textarea area
            document.getElementById('word-count-display').textContent = `Words: ${wordCount}/${maxWords}`;

            var updateButton = document.getElementById('update-btn');
            var wordCountError = document.getElementById('word-count-error');

            // Disable the update button if word count exceeds the limit
            if (wordCount > maxWords) {
                updateButton.disabled = true;
                wordCountError.style.display = 'block';
            } else {
                updateButton.disabled = false;
                wordCountError.style.display = 'none';
            }
        }
    </script>
@endsection
