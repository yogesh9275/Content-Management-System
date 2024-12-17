@section('title', 'Edit Home Page Element')
@extends('layouts.home')

@section('page')
    <div class="container mt-5">
        <h3 class="mb-4 text-primary">Edit Home Page Element</h3>
        <form action="{{ route('homepage.update', $element->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH') <!-- Specify the PATCH method for update -->

            <!-- Element Type -->
            <div class="mb-4">
                <label for="element" class="form-label text-dark fw-bold">Element Type</label>
                <select class="form-select" name="element" id="element" onchange="toggleDivs()" required>
                    <option value="" disabled>Select an element</option>
                    <option value="title" {{ $element->type == 'title' ? 'selected' : '' }}>Title</option>
                    <option value="description" {{ $element->type == 'description' ? 'selected' : '' }}>Description</option>
                    <option value="image" {{ $element->type == 'image' ? 'selected' : '' }}>Image</option>
                    <option value="about-title" {{ $element->type == 'about-title' ? 'selected' : '' }}>About-Title</option>
                    <option value="about-description" {{ $element->type == 'about-description' ? 'selected' : '' }}>About-Description</option>
                    <option value="about-image" {{ $element->type == 'about-image' ? 'selected' : '' }}>About-Image</option>
                    <option value="vision-title" {{ $element->type == 'vision-title' ? 'selected' : '' }}>Vision-Title</option>
                    <option value="vision-description" {{ $element->type == 'vision-description' ? 'selected' : '' }}>Vision-Description</option>
                    <option value="vision-image" {{ $element->type == 'vision-image' ? 'selected' : '' }}>Vision-Image</option>
                    <option value="slider-image" {{ $element->type == 'slider-image' ? 'selected' : '' }}>Slider-Image</option>
                </select>
            </div>

            <!-- Div for Title -->
            <div class="mb-4 element-div" id="title" style="display:none;">
                <label for="data-title" class="form-label text-dark fw-bold">Title</label>
                <input type="text" class="form-control" name="data-title" id="data-title" value="{{ $element->content }}">
            </div>

            <!-- Div for Description -->
            <div class="mb-4 element-div" id="description" style="display:none;">
                <label for="data-description" class="form-label text-dark fw-bold">Description</label>
                <textarea class="form-control" name="data-description" id="data-description" rows="10">{{ $element->content }}</textarea>
                <div id="word-count-error" class="text-danger" style="display: none;">Description exceeds the word limit. Please shorten it.</div>
                <div id="word-count-display" class="mt-2 text-muted">Words: 0/250</div>
            </div>

            <!-- Div for Image -->
            <div class="mb-4 element-div position-relative" id="image" style="display:none;">
                <label for="data-image" class="form-label text-dark fw-bold">Upload Image</label>
                <input type="file" class="form-control" name="data-image" id="data-image" accept="image/*">
                @if($element->content && $element->type == 'image')
                    <div class="mt-3">
                        <img src="{{ asset($element->content) }}" class="img-thumbnail mb-2" alt="Current Image" style="max-height: 150px;">
                    </div>
                @endif
            </div>

            <!-- Similar Divs for About, Vision, Slider fields -->
            <!-- Example for Vision Title -->
            <div class="mb-4 element-div" id="vision-title" style="display:none;">
                <label for="data-vision-title" class="form-label text-dark fw-bold">Vision Title</label>
                <input type="text" class="form-control" name="data-vision-title" id="data-vision-title" value="{{ $element->content }}">
            </div>

            <div class="d-flex justify-content-between">
                <a id="back-btn" href="{{ route('homepage.index') }}" class="btn btn-secondary">Back</a>
                <button id="update-btn" type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>

    <script>
        // Pre-select the relevant div based on type
        document.addEventListener('DOMContentLoaded', function () {
            toggleDivs();
            document.getElementById('element').value = '{{ $element->type }}';

            // Initialize word count for description fields
            updateWordCount('data-description', 'word-count-display', 'word-count-error', 250);
        });

        // Other functions (handleImageUpload, toggleDivs, etc.) remain unchanged
    </script>
@endsection
