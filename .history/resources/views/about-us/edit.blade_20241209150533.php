<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit About Us Element</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

        // Call toggleDivs function on page load to set the initial state
        window.onload = toggleDivs;
    </script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Edit About Us Element</h3>
            </div>
            <div class="card-body">
                <form action="/about-us/{{ $element->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="element" class="form-label">Element</label>
                        <select class="form-select" name="element" id="element" onchange="toggleDivs()" required>
                            <option value="Header" {{ $element->element == 'Header' ? 'selected' : '' }}>Header</option>
                            <option value="Paragraph" {{ $element->element == 'Paragraph' ? 'selected' : '' }}>Paragraph</option>
                            <option value="Image" {{ $element->element == 'Image' ? 'selected' : '' }}>Image</option>
                            <option value="Video" {{ $element->element == 'Video' ? 'selected' : '' }}>Video</option>
                            <option value="Long Text" {{ $element->element == 'Long Text' ? 'selected' : '' }}>Long Text</option>
                        </select>
                    </div>

                    <!-- Div for Header -->
                    <div class="mb-3 element-div" id="Header" style="display:none;">
                        <label for="data-header" class="form-label">Header Data</label>
                        <input type="text" class="form-control" name="data-header" id="data-header" value="{{ $element->data }}">
                    </div>

                    <!-- Div for Paragraph -->
                    <div class="mb-3 element-div" id="Paragraph" style="display:none;">
                        <label for="data-paragraph" class="form-label">Paragraph Data</label>
                        <textarea class="form-control" name="data-paragraph" id="data-paragraph" rows="5">{{ $element->data }}</textarea>
                    </div>

                    <!-- Div for Image -->
                    <div class="mb-3 element-div" id="Image" style="display:none;">
                        <label for="data-image" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" name="data-image" id="data-image" accept="image/*">
                        @if ($element->element == 'Image' && $element->data)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $element->data) }}" alt="Uploaded Image" width="150">
                            </div>
                        @endif
                    </div>

                    <!-- Div for Video -->
                    <div class="mb-3 element-div" id="Video" style="display:none;">
                        <label for="data-video" class="form-label">Upload Video</label>
                        <input type="file" class="form-control" name="data-video" id="data-video" accept="video/mp4, video/avi, video/mkv, video/webm">
                        @if ($element->element == 'Video' && $element->data)
                            <div class="mt-2">
                                <video controls width="150">
                                    <source src="{{ asset($element->data) }}" type="video/mp4">
                                </video>
                            </div>
                        @endif
                    </div>

                    <!-- Div for Long Text -->
                    <div class="mb-3 element-div" id="Long Text" style="display:none;">
                        <label for="data-long-text" class="form-label">Long Text Data</label>
                        <textarea class="form-control" name="data-long-text" id="data-long-text" rows="10">{{ $element->data }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="/about-us" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
