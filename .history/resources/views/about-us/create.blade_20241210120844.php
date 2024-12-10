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
                <input type="file" class="form-control" name="data-image" id="data-image" accept="image/*" onchange="checkImageSize(event)">
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
</body>
@endsection
