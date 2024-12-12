>@yield('title', 'Add About Us Element')
@extends('layouts.home')

@section('page')
    <div class="container mt-5">
        <h3 class="mb-4 text-primary">Add About Us Element</h3>
        <form action="/about-us/store" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="element" class="form-label">Element Type</label>
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
                <label for="data-header" class="form-label">Header Data</label>
                <input type="text" class="form-control" name="data-header" id="data-header">
            </div>

            <!-- Div for Paragraph -->
            <div class="mb-4 element-div" id="Paragraph" style="display:none;">
                <label for="data-paragraph" class="form-label">Paragraph Data</label>
                <textarea class="form-control" name="data-paragraph" id="data-paragraph" rows="5"></textarea>
            </div>

            <!-- Div for Image -->
            <div class="mb-4 element-div" id="Image" style="display:none;">
                <label for="data-image" class="form-label">Upload Image</label>
                <!-- File input to accept image files -->
                <input type="file" class="form-control" name="data-image" id="data-image" accept="image/*"
                    onchange="checkImageSize(event)">
                <!-- Error message for file size -->
                <div id="file-size-error" class="text-danger mt-2"></div>
            </div>

            <!-- Div for Long Text -->
            <div class="mb-4 element-div" id="Long Text" style="display:none;">
                <label for="data-long-text" class="form-label">Long Text Data</label>
                <textarea class="form-control" name="data-long-text" id="data-long-text" rows="10"></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="/about-us" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
    <script>
        // Function to toggle divs based on selected element type
        function toggleDivs() {
            var selectedElement = document.getElementById("element").value;

            // Hide all divs first
            var allDivs = document.querySelectorAll(".element-div");
            allDivs.forEach(function(div) {
                div.style.display = "none";
            });

            // Show the div for the selected element
            if (selectedElement) {
                var selectedDiv = document.getElementById(selectedElement);
                if (selectedDiv) {
                    selectedDiv.style.display = "block";
                }
            }
        }

        // Function to check image size before submitting the form
        function checkImageSize(event) {
            const fileInput = event.target;
            const file = fileInput.files[0];

            if (file) {
                const fileSize = file.size / 1024 / 1024; // Convert to MB
                const maxSize = 2; // 2 MB

                if (fileSize > maxSize) {
                    // Show error message and clear the file input
                    document.getElementById("file-size-error").textContent =
                        "File size exceeds 2MB. Please upload a smaller image.";
                    fileInput.value = ""; // Clear the file input
                } else {
                    // Clear any previous error message
                    document.getElementById("file-size-error").textContent = "";
                }
            }
        }

        // Call toggleDivs function on page load to set the initial state
        window.onload = toggleDivs;
    </script>
@endsection
