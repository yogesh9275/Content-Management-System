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

                    <!-- Image Preview -->
                    <div class="mt-3" id="image-preview"
                    style="display: {{ $element->element == 'Image' && $element->data ? 'block;' : 'none;' }}">
                    <img id="preview-img"
                        src="{{ $element->element == 'Image' && $element->data ? asset($element->data) : '' }}"
                        class="img-thumbnail mb-2" alt="Image Preview" style="max-width: 100%; max-height: 20rem;">
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
        // Save the original image path on page load (use the existing data from your server)
        var originalImageSrc = '{{ $element->element == 'Image' && $element->data ? asset($element->data) : asset('images/default-image.png') }}';
        var image = document.getElementById('preview-img');
        var cancelBtn = document.getElementById('cancel-btn');
        var fileInput = document.getElementById('data-image');
        var fileSizeError = document.getElementById("file-size-error");

        // Event listener to change the image preview when a new file is selected
        fileInput.addEventListener('change', function(event) {
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                image.src = e.target.result; // Update the image source to the new uploaded file
                cancelBtn.style.display = 'inline-block'; // Show the cancel button
            };

            if (file) {
                const fileSize = file.size / 1024 / 1024; // Convert bytes to MB
                const maxSize = 2; // 2MB max file size

                if (fileSize > maxSize) {
                    fileSizeError.textContent = "File size exceeds 2MB. Please upload a smaller image.";
                    fileInput.value = ''; // Clear input
                    image.src = originalImageSrc; // Restore the original image if size exceeds
                    cancelBtn.style.display = 'none'; // Hide cancel button
                    return;
                }

                fileSizeError.textContent = ''; // Clear file size error message
                reader.readAsDataURL(file); // Read and load the selected file
            }
        });

        // Event listener for the cancel button to clear the input and restore the original image
        cancelBtn.addEventListener('click', function() {
            fileInput.value = ''; // Clear the file input
            image.src = originalImageSrc; // Restore the original image
            cancelBtn.style.display = 'none'; // Hide the cancel button
        });
    </script>


@endsection
