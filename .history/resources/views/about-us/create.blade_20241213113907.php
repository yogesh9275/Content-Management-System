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
            <div class="mb-4 element-div" id="Image" style="display:none;">
                <label for="data-image" class="form-label text-dark fw-bold">Upload Image</label>
                <!-- File input to accept image files -->
                <input type="file" class="form-control" name="data-image" id="data-image" accept="image/*">
                
                <!-- Placeholder for the image preview -->
                <div class="mt-3" id="image-preview" style="display: none;">
                    <img id="preview-img" src="" class="img-thumbnail mb-2" alt="Image Preview" style="max-width: 100%; max-height: 20rem;">
                    <button type="button" class="btn btn-danger btn-sm" id="cancel-preview">Cancel</button>
                </div>
                <!-- Error message for file size -->
                <div id="file-size-error" class="text-danger mt-2"></div>
            </div>

            <!-- Div for Long Text -->
            <div class="mb-4 element-div" id="Long Text" style="display:none;">
                <div class="form-label text-dark fw-bold">Long Text Data</div>
                <div id="editor">
                    <div id="edit">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a id="back-btn" href="{{ route('about-us.index') }}" class="btn btn-secondary">Back</a>
                <button id="create-btn" type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>

    <script>
        function toggleDivs() {
            var selectedElement = document.getElementById("element").value;
            var allDivs = document.querySelectorAll(".element-div");
            allDivs.forEach(function(div) {
                div.style.display = "none";
            });
            if (selectedElement) {
                var selectedDiv = document.getElementById(selectedElement);
                if (selectedDiv) {
                    selectedDiv.style.display = "block";
                }
            }
        }

        const imageInput = document.getElementById("data-image");
        const imagePreview = document.getElementById("image-preview");
        const previewImg = document.getElementById("preview-img");
        const cancelPreview = document.getElementById("cancel-preview");
        const fileSizeError = document.getElementById("file-size-error");

        imageInput.addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const fileSize = file.size / 1024 / 1024;
                const maxSize = 2;

                if (fileSize > maxSize) {
                    fileSizeError.textContent = "File size exceeds 2MB. Please upload a smaller image.";
                    imageInput.value = "";
                    imagePreview.style.display = "none";
                    return;
                }

                fileSizeError.textContent = "";
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    imagePreview.style.display = "block";
                };
                reader.readAsDataURL(file);
            }
        });

        cancelPreview.addEventListener("click", function() {
            imageInput.value = "";
            imagePreview.style.display = "none";
        });

        window.onload = toggleDivs;
    </script>
@endsection
