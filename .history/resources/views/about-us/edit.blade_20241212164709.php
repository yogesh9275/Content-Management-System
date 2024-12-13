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
                    <label for="element" class="form-label">Element Type</label>
                    <select class="form-select" name="element" id="element" onchange="toggleDivs()" required>
                        <option value="Header" {{ $element->element == 'Header' ? 'selected' : '' }}>Header</option>
                        <option value="Paragraph" {{ $element->element == 'Paragraph' ? 'selected' : '' }}>Paragraph</option>
                        <option value="Image" {{ $element->element == 'Image' ? 'selected' : '' }}>Image</option>
                        <option value="Long Text" {{ $element->element == 'Long Text' ? 'selected' : '' }}>Long Text</option>
                    </select>
                </div>

                <!-- Div for Header -->
                <div class="mb-4 element-div" id="Header" style="display:none;">
                    <label for="data-header" class="form-label">Header Data</label>
                    <input type="text" class="form-control" name="data-header" id="data-header" value="{{ $element->data }}">
                </div>

                <!-- Div for Paragraph -->
                <div class="mb-4 element-div" id="Paragraph" style="display:none;">
                    <label for="data-paragraph" class="form-label">Paragraph Data</label>
                    <textarea class="form-control" name="data-paragraph" id="data-paragraph" rows="5">{{ $element->data }}</textarea>
                </div>

                <!-- Div for Image -->
                <div class="mb-4 element-div" id="Image" style="display:none;">
                    <label for="data-image" class="form-label">Upload Image</label>
                    <input type="file" class="form-control" name="data-image" id="data-image" accept="image/*">
                    @if ($element->element == 'Image' && $element->data)
                        <div class="mt-3">
                            <img src="{{ asset($element->data) }}" alt="Uploaded Image" width="800">
                        </div>
                    @endif
                </div>

                <!-- Div for Long Text -->
                <div class="mb-4 element-div" id="Long Text" style="display:none;">
                    <div class="form-label">Long Text Data</div>
                    <div id="editor">
                        <div id="edit" contenteditable="true">
                            @php
                                // Convert newline characters (\n) into <p> tags for each line
                                $details = nl2br(e($element->data)); // Escape HTML and convert \n to <br>
                                // Wrap text in <p> for each line
                                $details = preg_replace('/\n/', '</p><p>', $details);
                                $details = '<p>' . $details . '</p>'; // Add the first <p> tag
                            @endphp
                            {!! $details !!}
                        </div>
                    </div>
                    <!-- Hidden textarea to store the HTML content -->
                    <textarea name="data-long-text" id="data-long-text" style="display:none;">{!! $element->data !!}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a id="back-btn" href="{{ route('about-us.index') }}" class="btn btn-secondary">Back</a>
                    <button id="update-btn" type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
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

    // Sync editable div content to the hidden textarea on form submission
    document.querySelector('form').addEventListener('submit', function() {
        var editorContent = document.getElementById('edit').innerHTML;
        console.log(editorContent);
        document.getElementById('data-long-text').value = editorContent;
    });

    // Call toggleDivs function on page load to set the initial state
    window.onload = toggleDivs;
</script>
@endsection
