@section('title', 'Add About Us Element')
@extends('layouts.home')

@section('page')
    <div class="container mt-5">
        <h3 class="mb-4 text-primary">Add About Us Element</h3>
        <form action="{{ route('about-us.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="element" class="form-label text-dark fw-bold">Element Type</label>
                <!-- Select dropdown for element types -->
                <select class="form-select" name="element" id="element" onchange="toggleDivs()" required>
                    <option value="" disabled selected>Select an element</option>
                    <option value="Header">Header</option>
                    <option value="Paragraph">Paragraph</option>
                    <option value="Image">Image</option>
                    <option value="Long Text">Long Text</option>
                </select>
            </div>

            <!-- Div for Header -->
            <div class="mb-4 element-div" id="Header" style="display:none;">
                <label for="data-header" class="form-label text-dark fw-bold">Header Data</label>
                <input type="text" class="form-control" name="data-header" id="data-header">
            </div>

            <!-- Div for Paragraph -->
            <div class="mb-4 element-div" id="Paragraph" style="display:none;">
                <label for="data-paragraph" class="form-label text-dark fw-bold">Paragraph Data</label>
                <textarea class="form-control" name="data-paragraph" id="data-paragraph" rows="5"></textarea>
            </div>

            <!-- Div for Image -->
            <div class="mb-4 element-div position-relative" id="Image" style="display:none;">
                <label for="data-image" class="form-label text-dark fw-bold">Upload Image</label>
                <!-- File input to accept image files -->
                <input type="file" class="form-control" name="data-image" id="data-image" accept="image/*">
                <!-- X button inside the input field, hidden by default -->
                <span id="cancel-btn" class="position-absolute" style="right: 0.40rem; bottom: 0.40rem; cursor: pointer; display:none;"><x-simpleline-close class="table-icon text-danger"/></span>
                <!-- Error message for file size -->
                <div id="file-size-error" class="text-danger mt-2"></div>
            </div>

            <!-- Placeholder for the image preview -->
            <div class="mt-3" id="image-preview" style="display: none;">
                <img id="preview-img" src="" class="img-thumbnail mb-2" alt="Image Preview" style="max-width: 100%; max-height: 20rem;">
            </div>

            <!-- Div for Long Text -->
            <div class="mb-4 element-div" id="Long Text" style="display:none;">
                <div class="form-label text-dark fw-bold">Long Text Data</div>
                <div id="editor">
                    <div id="edit">
                    </div>
                </div>
            </div>

            <input type="hidden" name="data-long-text" id="data-long-text">

            <div class="d-flex justify-content-between">
                <a id="back-btn" href="{{ route('about-us.index') }}" class="btn btn-secondary">Back</a>
                <button id="create-btn" type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>

    <!-- Include the external JavaScript file -->
    <script src="{{ asset('js/pages/home_create.js') }}"></script>
@endsection
