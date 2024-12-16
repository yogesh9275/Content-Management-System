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
                            <option value="Title" {{ $homePage->element == 'Title' ? 'selected' : '' }}>Title</option>
                            <option value="Description" {{ $homePage->element == 'Description' ? 'selected' : '' }}>Description</option>
                            <option value="Image" {{ $homePage->element == 'Image' ? 'selected' : '' }}>Image</option>
                        </select>
                    </div>

                    <!-- Div for Title -->
                    <div class="mb-4 element-div" id="Title" style="display: {{ $homePage->element == 'Title' ? 'block' : 'none' }}">
                        <label for="data-title" class="form-label text-dark fw-bold">Title Data</label>
                        <input type="text" class="form-control" name="data-title" id="data-title" value="{{ $homePage->data }}">
                    </div>

                    <!-- Div for Description -->
                    <div class="mb-4 element-div" id="Description" style="display: {{ $homePage->element == 'Description' ? 'block' : 'none' }}">
                        <label for="data-description" class="form-label text-dark fw-bold">Description Data</label>
                        <textarea class="form-control" name="data-description" id="data-description" rows="10">{{ $homePage->data }}</textarea>
                        <div id="word-count-error" class="text-danger" style="display: none;">Description exceeds the word limit. Please shorten it.</div>
                    </div>

                    <!-- Div for Image -->
                    <div class="mb-4 element-div position-relative" id="Image" style="display: {{ $homePage->element == 'Image' && $homePage->data ? 'block' : 'none' }};">
                        <label for="data-image" class="form-label text-dark fw-bold">Upload Image</label>

                        <!-- File input to accept image files -->
                        <input type="file" class="form-control" name="data-image" id="data-image" accept="image/*">

                        <!-- X button inside the input field, hidden by default -->
                        <span id="cancel-btn" class="position-absolute" style="right: 0.40rem; bottom: 0.40rem; cursor: pointer; display:none;">
                            <x-simpleline-close class="table-icon text-danger" />
                        </span>

                        <!-- Error message for file size -->
                        <div id="file-size-error" class="text-danger mt-2"></div>
                    </div>

                    <!-- Image Preview -->
                    <div class="mt-3" id="image-preview" style="display: {{ $homePage->element == 'Image' && $homePage->data ? 'block' : 'none' }};">
                        <img id="preview-img" src="{{ $homePage->element == 'Image' && $homePage->data ? asset($homePage->data) : '' }}" class="img-thumbnail mb-2" alt="Image Preview" style="max-width: 100%; max-height: 100%;">
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
        var originalImageSrc = '{{ $homePage->element == 'Image' && $homePage->data ? asset($homePage->data) : asset('images/default-image.png') }}';
        var image = document.getElementById('preview-img');
        var cancelBtn = document.getElementById('cancel-btn');
        var fileInput = document.getElementById('data-image');
        var fileSizeError = document.getElementById("file-size-error");

        // Handle file upload and preview
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

        // Toggle visibility of element-specific sections
        function toggleDivs() {
            const selectedElement = document.getElementById('element').value;
            const elementDivs = document.querySelectorAll('.element-div');
            elementDivs.forEach(function(div) {
                div.style.display = div.id === selectedElement ? 'block' : 'none';
            });
        }

        // Set initial state based on the selected element
        document.addEventListener('DOMContentLoaded', toggleDivs);

        // Word count check for the description textarea
        document.getElementById('data-description').addEventListener('input', function() {
            var descriptionTextarea = document.getElementById('data-description');
            var wordCount = descriptionTextarea.value.split(/\s+/).filter(Boolean).length; // Count words

            var maxWords = 150; // Maximum words allowed

            // Disable the update button if word count exceeds limit
            var updateButton = document.getElementById('update-btn');
            var wordCountError = document.getElementById('word-count-error');

            if (wordCount > maxWords) {
                updateButton.disabled = true;
                wordCountError.style.display = 'block';
            } else {
                updateButton.disabled = false;
                wordCountError.style.display = 'none';
            }
        });
    </script>
@endsection