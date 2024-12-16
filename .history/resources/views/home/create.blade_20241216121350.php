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
                    <option value="Title">Title</option>
                    <option value="Description">Description</option>
                    <option value="Image">Image</option>
                    <option value="About-Title">About-Title</option>
                    <option value="About-Description">Description</option>
                    <option value="About-Image">Image</option>
                </select>
            </div>

            <!-- Div for Title -->
            <div class="mb-4 element-div" id="Title" style="display:none;">
                <label for="data-title" class="form-label text-dark fw-bold">Title</label>
                <input type="text" class="form-control" name="data-title" id="data-title">
            </div>

            <!-- Div for Description -->
            <div class="mb-4 element-div" id="Description" style="display:none;">
                <label for="data-description" class="form-label text-dark fw-bold">Description</label>
                <textarea class="form-control" name="data-description" id="data-description" rows="5"></textarea>
            </div>

            <!-- Div for Image -->
            <div class="mb-4 element-div position-relative" id="Image" style="display:none;">
                <label for="data-image" class="form-label text-dark fw-bold">Upload Image</label>
                <input type="file" class="form-control" name="data-image" id="data-image" accept="image/*">
                <span id="cancel-btn" class="position-absolute" style="right: 0.40rem; bottom: 0.40rem; cursor: pointer; display:none;"><x-simpleline-close class="table-icon text-danger"/></span>
                <div id="file-size-error" class="text-danger mt-2"></div>
            </div>

            <div class="mt-3" id="image-preview" style="display: none;">
                <img id="preview-img" src="" class="img-thumbnail mb-2" alt="Image Preview" style="max-width: 100%; max-height: 20rem;">
            </div>

            <div class="d-flex justify-content-between">
                <a id="back-btn" href="{{ route('homepage.index') }}" class="btn btn-secondary">Back</a>
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
        const cancelBtn = document.getElementById("cancel-btn");
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
                    cancelBtn.style.display = "none";
                    return;
                }

                fileSizeError.textContent = "";
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    imagePreview.style.display = "block";
                    cancelBtn.style.display = "inline-block";
                };
                reader.readAsDataURL(file);
            }
        });

        cancelBtn.addEventListener("click", function() {
            imageInput.value = "";
            imagePreview.style.display = "none";
            cancelBtn.style.display = "none";
        });

        window.onload = toggleDivs;
    </script>
@endsection
