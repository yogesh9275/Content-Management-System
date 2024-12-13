@section('title', 'Edit About Us Element')
@extends('layouts.home')

@section('page')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-4 text-primary">Edit About Us Element</h3>
                <form action="{{ route('about-us.update', $element->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="element" class="form-label text-dark fw-bold">Element Type</label>
                        <select class="form-select" name="element" id="element" onchange="toggleDivs()" required>
                            <option value="Header" {{ $element->element == 'Header' ? 'selected' : '' }}>Header</option>
                            <option value="Paragraph" {{ $element->element == 'Paragraph' ? 'selected' : '' }}>Paragraph
                            </option>
                            <option value="Image" {{ $element->element == 'Image' ? 'selected' : '' }}>Image</option>
                            <option value="Long Text" {{ $element->element == 'Long Text' ? 'selected' : '' }}>Long Text
                            </option>
                        </select>
                    </div>

                    <!-- Div for Header -->
                    <div class="mb-4 element-div" id="Header" style="display:none;">
                        <label for="data-header" class="form-label text-dark fw-bold">Header Data</label>
                        <input type="text" class="form-control" name="data-header" id="data-header"
                            value="{{ $element->data }}">
                    </div>

                    <!-- Div for Paragraph -->
                    <div class="mb-4 element-div" id="Paragraph" style="display:none;">
                        <label for="data-paragraph" class="form-label text-dark fw-bold">Paragraph Data</label>
                        <textarea class="form-control" name="data-paragraph" id="data-paragraph" rows="5">{{ $element->data }}</textarea>
                    </div>

                    <!-- Div for Image -->
                    <div class="mb-4 element-div position-relative" id="Image"
                        style="{{ $element->element == 'Image' ? 'display:block;' : 'display:none;' }}">
                        <label for="data-image" class="form-label text-dark fw-bold">Upload Image</label>

                        <!-- File input to accept image files -->
                        <input type="file" class="form-control" name="data-image" id="data-image" accept="image/*">

                        <!-- X button inside the input field, hidden by default -->
                        <span id="cancel-btn" class="position-absolute"
                            style="right: 0.40rem; bottom: 0.40rem; cursor: pointer; display:none;">
                            <x-simpleline-close class="table-icon text-danger" />
                        </span>

                        <!-- Error message for file size -->
                        <div id="file-size-error" class="text-danger mt-2"></div>
                    </div>


                    <!-- Div for Long Text -->
                    <div class="mb-4 element-div" id="Long Text" style="display:none;">
                        <div class="form-label text-dark fw-bold">Long Text Data</div>
                        <div id="editor">
                            <div id="edit">
                                {!! $element->data !!}
                            </div>
                        </div>
                    </div>


                    <input type="hidden" name="data-long-text" id="data-long-text">

                    <div class="d-flex justify-content-between">
                        <a id="back-btn" href="{{ route('about-us.index') }}" class="btn btn-secondary">Back</a>
                        <button id="update-btn" type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const imageInput = document.getElementById("data-image");
        const imagePreview = document.getElementById("image-preview");
        const previewImg = document.getElementById("preview-img");
        const cancelBtn = document.getElementById("cancel-btn");
        const fileSizeError = document.getElementById("file-size-error");

        // Handle the change event for image input
        imageInput.addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const fileSize = file.size / 1024 / 1024; // Convert bytes to MB
                const maxSize = 2; // 2MB max file size

                if (fileSize > maxSize) {
                    fileSizeError.textContent = "File size exceeds 2MB. Please upload a smaller image.";
                    imageInput.value = ""; // Clear input
                    imagePreview.style.display = "none"; // Hide the preview
                    cancelBtn.style.display = "none"; // Hide the cancel button
                    return;
                }

                fileSizeError.textContent = "";
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    imagePreview.style.display = "block"; // Show the preview
                    cancelBtn.style.display = "inline-block"; // Show the cancel button
                };
                reader.readAsDataURL(file);
            }
        });

        // Cancel the image selection and hide the preview
        cancelBtn.addEventListener("click", function() {
            imageInput.value = ""; // Clear the file input
            imagePreview.style.display = "none"; // Hide the preview
            cancelBtn.style.display = "none"; // Hide the cancel button
        });
    </script>

@endsection
