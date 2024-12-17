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
                    <option value="title">Title</option>
                    <option value="description">Description</option>
                    <option value="image">Image</option>
                    <option value="about-title">About-Title</option>
                    <option value="about-description">About-Description</option>
                    <option value="about-image">About-Image</option>
                    <option value="vision-title">Vision-Title</option>
                    <option value="vision-description">Vision-Description</option>
                    <option value="vision-image">Vision-Image</option>
                    <option value="slider-image">Slider-Image</option>
                </select>
            </div>

            <!-- Div for Title -->
            <div class="mb-4 element-div" id="title" style="display:none;">
                <label for="data-title" class="form-label text-dark fw-bold">Title</label>
                <input type="text" class="form-control" name="data-title" id="data-title">
            </div>

            <!-- Div for Description -->
            <div class="mb-4 element-div" id="description" style="display:none;">
                <label for="data-description" class="form-label text-dark fw-bold">Description</label>
                <textarea class="form-control" name="data-description" id="data-description" rows="10"></textarea>
                <div id="word-count-error" class="text-danger" style="display: none;">Description exceeds the word limit.
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
                <input type="text" class="form-control" name="data-about-title" id="data-about-title">
            </div>

            <!-- Div for About Description -->
            <div class="mb-4 element-div" id="about-description" style="display:none;">
                <label for="data-about-description" class="form-label text-dark fw-bold">About Description</label>
                <textarea class="form-control" name="data-about-description" id="data-about-description" rows="10"></textarea>
                <div id="about-word-count-error" class="text-danger" style="display: none;">Description exceeds the word
                    limit. Please shorten it.</div>
                <div id="about-word-count-display" class="mt-2 text-muted">Words: 0/250</div>
            </div>

            <!-- Div for About Image -->
            <div class="mb-4 element-div position-relative" id="about-image" style="display:none;">
                <label for="data-about-image" class="form-label text-dark fw-bold">Upload About Image</label>
                <input type="file" class="form-control" name="data-about-image" id="data-about-image" accept="image/*">
                <span id="about-cancel-btn" class="position-absolute"
                    style="right: 0.40rem; bottom: 0.40rem; cursor: pointer; display:none;">
                    <x-simpleline-close class="table-icon text-danger" />
                </span>
                <div id="about-file-size-error" class="text-danger mt-2"></div>
            </div>

            <!-- Div for Vision Title -->
            <div class="mb-4 element-div" id="vision-title" style="display:none;">
                <label for="data-vision-title" class="form-label text-dark fw-bold">Vision Title</label>
                <input type="text" class="form-control" name="data-vision-title" id="data-vision-title">
            </div>

            <!-- Div for Vision Description -->
            <div class="mb-4 element-div" id="vision-description" style="display:none;">
                <label for="data-vision-description" class="form-label text-dark fw-bold">Vision Description</label>
                <textarea class="form-control" name="data-vision-description" id="data-vision-description" rows="10"></textarea>
                <div id="vision-word-count-error" class="text-danger" style="display: none;">Description exceeds the word
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
            <div class="mt-3" id="image-preview" style="display: none;">
                <img id="preview-img" src="" class="img-thumbnail mb-2" alt="Image Preview"
                    style="max-width: 100%; max-height: 20rem;">
            </div>

            <div class="d-flex justify-content-between">
                <a id="back-btn" href="#" class="btn btn-secondary">Back</a>
                <button id="create-btn" type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>

    <!-- Include the external JavaScript file -->
    @section('scripts')
    <script src="{{ asset('js/pages/home_create.js') }}"></script>
    
@endsection