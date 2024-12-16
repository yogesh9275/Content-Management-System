@section('title', 'Edit Home Page Element')
@extends('layouts.home')

@section('page')
    <div class="container mt-5">
        <h3 class="mb-4 text-primary">Edit Home Page Element</h3>
        <form action="{{ route('homepage.update', $homePage->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Element Select Dropdown -->
            <div class="mb-4">
                <label for="element" class="form-label text-dark fw-bold">Element Type</label>
                <select class="form-select" name="element" id="element" onchange="toggleDivs()" required>
                    <option value="" disabled>Select an element</option>
                    <option value="title" {{ $homePage->element == 'title' ? 'selected' : '' }}>Title</option>
                    <option value="description" {{ $homePage->element == 'description' ? 'selected' : '' }}>Description</option>
                    <option value="image" {{ $homePage->element == 'image' ? 'selected' : '' }}>Image</option>
                    <option value="about-title" {{ $homePage->element == 'about-title' ? 'selected' : '' }}>About-Title</option>
                    <option value="about-description" {{ $homePage->element == 'about-description' ? 'selected' : '' }}>About-Description</option>
                    <option value="about-image" {{ $homePage->element == 'about-image' ? 'selected' : '' }}>About-Image</option>
                    <option value="vision-title" {{ $homePage->element == 'vision-title' ? 'selected' : '' }}>Vision-Title</option>
                    <option value="vision-description" {{ $homePage->element == 'vision-description' ? 'selected' : '' }}>Vision-Description</option>
                    <option value="vision-image" {{ $homePage->element == 'vision-image' ? 'selected' : '' }}>Vision-Image</option>
                    <option value="slider-image" {{ $homePage->element == 'slider-image' ? 'selected' : '' }}>Slider-Image</option>
                </select>
            </div>

            <!-- Div for Title -->
            <div class="mb-4 element-div" id="title" style="display:none;">
                <label for="data-title" class="form-label text-dark fw-bold">Title</label>
                <input type="text" class="form-control" name="data-title" id="data-title" value="{{ old('data-title', $homePage->data_title) }}">
            </div>

            <!-- Div for Description -->
            <div class="mb-4 element-div" id="description" style="display:none;">
                <label for="data-description" class="form-label text-dark fw-bold">Description</label>
                <textarea class="form-control" name="data-description" id="data-description" rows="10">{{ old('data-description', $homePage->data_description) }}</textarea>
                <div id="word-count-error" class="text-danger" style="display: none;">Description exceeds the word limit. Please shorten it.</div>
                <div id="word-count-display" class="mt-2 text-muted">Words: 0/250</div>
            </div>

            <!-- Div for Image -->
            <div class="mb-4 element-div position-relative" id="image" style="display:none;">
                <label for="data-image" class="form-label text-dark fw-bold">Upload Image</label>
                <input type="file" class="form-control" name="data-image" id="data-image" accept="image/*">
                <span id="cancel-btn" class="position-absolute" style="right: 0.40rem; bottom: 0.40rem; cursor: pointer; display:none;">
                    <x-simpleline-close class="table-icon text-danger"/>
                </span>
                <div id="file-size-error" class="text-danger mt-2"></div>
            </div>

            <!-- Div for About Title -->
            <div class="mb-4 element-div" id="about-title" style="display:none;">
                <label for="data-about-title" class="form-label text-dark fw-bold">About Title</label>
                <input type="text" class="form-control" name="data-about-title" id="data-about-title" value="{{ old('data-about-title', $homePage->data_about_title) }}">
            </div>

            <!-- Div for About Description -->
            <div class="mb-4 element-div" id="about-description" style="display:none;">
                <label for="data-about-description" class="form-label text-dark fw-bold">About Description</label>
                <textarea class="form-control" name="data-about-description" id="data-about-description" rows="10">{{ old('data-about-description', $homePage->data_about_description) }}</textarea>
                <div id="about-word-count-error" class="text-danger" style="display: none;">Description exceeds the word limit. Please shorten it.</div>
                <div id="about-word-count-display" class="mt-2 text-muted">Words: 0/250</div>
            </div>

            <!-- Div for About Image -->
            <div class="mb-4 element-div position-relative" id="about-image" style="display:none;">
                <label for="data-about-image" class="form-label text-dark fw-bold">Upload About Image</label>
                <input type="file" class="form-control" name="data-about-image" id="data-about-image" accept="image/*">
                <span id="about-cancel-btn" class="position-absolute" style="right: 0.40rem; bottom: 0.40rem; cursor: pointer; display:none;">
                    <x-simpleline-close class="table-icon text-danger"/>
                </span>
                <div id="about-file-size-error" class="text-danger mt-2"></div>
            </div>

            <!-- Div for Vision Title -->
            <div class="mb-4 element-div" id="vision-title" style="display:none;">
                <label for="data-vision-title" class="form-label text-dark fw-bold">Vision Title</label>
                <input type="text" class="form-control" name="data-vision-title" id="data-vision-title" value="{{ old('data-vision-title', $homePage->data_vision_title) }}">
            </div>

            <!-- Div for Vision Description -->
            <div class="mb-4 element-div" id="vision-description" style="display:none;">
                <label for="data-vision-description" class="form-label text-dark fw-bold">Vision Description</label>
                <textarea class="form-control" name="data-vision-description" id="data-vision-description" rows="10">{{ old('data-vision-description', $homePage->data_vision_description) }}</textarea>
                <div id="vision-word-count-error" class="text-danger" style="display: none;">Description exceeds the word limit. Please shorten it.</div>
                <div id="vision-word-count-display" class="mt-2 text-muted">Words: 0/250</div>
            </div>

            <!-- Div for Vision Image -->
            <div class="mb-4 element-div position-relative" id="vision-image" style="display:none;">
                <label for="data-vision-image" class="form-label text-dark fw-bold">Upload Vision Image</label>
                <input type="file" class="form-control" name="data-vision-image" id="data-vision-image" accept="image/*">
                <span id="vision-cancel-btn" class="position-absolute" style="right: 0.40rem; bottom: 0.40rem; cursor: pointer; display:none;">
                    <x-simpleline-close class="table-icon text-danger"/>
                </span>
                <div id="vision-file-size-error" class="text-danger mt-2"></div>
            </div>

            <!-- Div for Slider Image -->
            <div class="mb-4 element-div position-relative" id="slider-image" style="display:none;">
                <label for="data-slider-image" class="form-label text-dark fw-bold">Upload Slider Image</label>
                <input type="file" class="form-control" name="data-slider-image" id="data-slider-image" accept="image/*">
                <span id="slider-cancel-btn" class="position-absolute" style="right: 0.40rem; bottom: 0.40rem; cursor: pointer; display:none;">
                    <x-simpleline-close class="table-icon text-danger"/>
                </span>
                <div id="slider-file-size-error" class="text-danger mt-2"></div>
            </div>

            <!-- Image Preview -->
            <div class="mt-3" id="image-preview" style="display: none;">
                <img id="preview-img" src="{{ asset($homePage->data_image) }}" class="img-thumbnail mb-2" alt="Image Preview" style="max-width: 100%; max-height: 20rem;">
            </div>

            <div class="d-flex justify-content-between">
                <a id="back-btn" href="{{ route('homepage.index') }}" class="btn btn-secondary">Back</a>
                <button id="update-btn" type="submit" class="btn btn-warning">Update Element</button>
            </div>
        </form>
    </div>

    <script>
        // Initialize the image preview function
        document.addEventListener('DOMContentLoaded', function() {
            toggleDivs(); // Toggle visibility based on element type selected
        });

        function toggleDivs() {
            var elementType = document.getElementById("element").value;

            // Hide all element-specific sections
            var elementDivs = document.querySelectorAll(".element-div");
            elementDivs.forEach(function(div) {
                div.style.display = 'none';
            });

            // Display the relevant div based on selection
            if (elementType) {
                document.getElementById(elementType).style.display = 'block';
            }
        }

        // Word count for descriptions
        document.getElementById("data-description").addEventListener('input', function() {
            handleWordCount('data-description', 'word-count-display', 'word-count-error');
        });

        document.getElementById("data-about-description").addEventListener('input', function() {
            handleWordCount('data-about-description', 'about-word-count-display', 'about-word-count-error');
        });

        document.getElementById("data-vision-description").addEventListener('input', function() {
            handleWordCount('data-vision-description', 'vision-word-count-display', 'vision-word-count-error');
        });

        // Validate word count
        function handleWordCount(textAreaId, countDisplayId, errorId) {
            var text = document.getElementById(textAreaId).value;
            var wordCount = text.split(/\s+/).filter(function(word) { return word.length > 0; }).length;
            document.getElementById(countDisplayId).innerHTML = 'Words: ' + wordCount + '/250';

            if (wordCount > 250) {
                document.getElementById(errorId).style.display = 'block';
                document.getElementById('update-btn').disabled = true;
            } else {
                document.getElementById(errorId).style.display = 'none';
                document.getElementById('update-btn').disabled = false;
            }
        }
    </script>
@endsection
