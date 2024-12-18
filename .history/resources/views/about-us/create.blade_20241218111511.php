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
                    <option value="Header">about-Header</option>
                    <option value="Paragraph">about-Paragraph</option>
                    <option value="Image">Image</option>
                    <option value="2004">2004</option>
                    <option value="2014">2014</option>
                    <option value="2016">2016</option>
                    <option value="2018">2018</option>
                    <option value="2021">2021</option>
                    <option value="2024">2024</option>
                </select>
            </div>

            <!-- Div for Header -->
            <div class="mb-4 element-div" id="Header" style="display:none;">
                <label for="data-header" class="form-label text-dark fw-bold">Header Data</label>
                <input type="text" class="form-control" name="data-header" id="data-header">
            </div>

            <!-- Div for Paragraph -->
            <div class="mb-4 element-div" id="Paragraph" style="display:none;">
                <label for="data-paragraph-Paragraph" class="form-label text-dark fw-bold">Paragraph Data</label>
                <textarea class="form-control" name="data-paragraph" id="data-paragraph-Paragraph" rows="5"></textarea>
                <div id="word-count-error-Paragraph" class="text-danger" style="display: none;">Description exceeds the word
                    limit. Please shorten it.</div>
                <div id="word-count-display-Paragraph" class="mt-2 text-muted">Words: 0/250</div>
            </div>

            <!-- Special Year Divs -->
            <div class="mb-4 element-div" id="2004" style="display:none;">
                <label for="data-paragraph-2004" class="form-label text-dark fw-bold">Paragraph for 2004</label>
                <textarea class="form-control" name="data-paragraph-2004" id="data-paragraph-2004" rows="5"></textarea>
                <div id="word-count-error-2004" class="text-danger" style="display: none;">Description exceeds the word
                    limit. Please shorten it.</div>
                <div id="word-count-display-2004" class="mt-2 text-muted">Words: 0/250</div>
            </div>

            <div class="mb-4 element-div" id="2014" style="display:none;">
                <label for="data-paragraph-2014" class="form-label text-dark fw-bold">Paragraph for 2014</label>
                <textarea class="form-control" name="data-paragraph-2014" id="data-paragraph-2014" rows="5"></textarea>
                <div id="word-count-error-2014" class="text-danger" style="display: none;">Description exceeds the word
                    limit. Please shorten it.</div>
                <div id="word-count-display-2014" class="mt-2 text-muted">Words: 0/250</div>
            </div>

            <div class="mb-4 element-div" id="2016" style="display:none;">
                <label for="data-paragraph-2016" class="form-label text-dark fw-bold">Paragraph for 2016</label>
                <textarea class="form-control" name="data-paragraph-2016" id="data-paragraph-2016" rows="5"></textarea>
                <div id="word-count-error-2016" class="text-danger" style="display: none;">Description exceeds the word
                    limit. Please shorten it.</div>
                <div id="word-count-display-2016" class="mt-2 text-muted">Words: 0/250</div>
            </div>

            <div class="mb-4 element-div" id="2018" style="display:none;">
                <label for="data-paragraph-2018" class="form-label text-dark fw-bold">Paragraph for 2018</label>
                <textarea class="form-control" name="data-paragraph-2018" id="data-paragraph-2018" rows="5"></textarea>
                <div id="word-count-error-2018" class="text-danger" style="display: none;">Description exceeds the word
                    limit. Please shorten it.</div>
                <div id="word-count-display-2018" class="mt-2 text-muted">Words: 0/250</div>
            </div>

            <div class="mb-4 element-div" id="2021" style="display:none;">
                <label for="data-paragraph-2021" class="form-label text-dark fw-bold">Paragraph for 2021</label>
                <textarea class="form-control" name="data-paragraph-2021" id="data-paragraph-2021" rows="5"></textarea>
                <div id="word-count-error-2021" class="text-danger" style="display: none;">Description exceeds the word
                    limit. Please shorten it.</div>
                <div id="word-count-display-2021" class="mt-2 text-muted">Words: 0/250</div>
            </div>

            <div class="mb-4 element-div" id="2024" style="display:none;">
                <label for="data-paragraph-2024" class="form-label text-dark fw-bold">Paragraph for 2024</label>
                <textarea class="form-control" name="data-paragraph-2024" id="data-paragraph-2024" rows="5"></textarea>
                <div id="word-count-error-2024" class="text-danger" style="display: none;">Description exceeds the word
                    limit. Please shorten it.</div>
                <div id="word-count-display-2024" class="mt-2 text-muted">Words: 0/250</div>
            </div>




            <!-- Div for Image -->
            <div class="mb-4 element-div position-relative" id="Image" style="display:none;">
                <label for="data-image" class="form-label text-dark fw-bold">Upload Image</label>
                <!-- File input to accept image files -->
                <input type="file" class="form-control" name="data-image" id="data-image" accept="image/*">
                <!-- X button inside the input field, hidden by default -->
                <span id="cancel-btn" class="position-absolute"
                    style="right: 0.40rem; bottom: 0.40rem; cursor: pointer; display:none;"><x-simpleline-close
                        class="table-icon text-danger" /></span>
                <!-- Error message for file size -->
                <div id="file-size-error" class="text-danger mt-2"></div>
            </div>

            <!-- Placeholder for the image preview -->
            <div class="mt-3" id="image-preview" style="display: none;">
                <img id="preview-img" src="" class="img-thumbnail mb-2" alt="Image Preview"
                    style="max-width: 100%; max-height: 20rem;">
            </div>

            <div class="d-flex justify-content-between">
                <a id="back-btn" href="{{ route('about-us.index') }}" class="btn btn-secondary">Back</a>
                <button id="create-btn" type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>

    <!-- Include the external JavaScript file -->
    <script src="{{ asset('js/pages/about_create.js') }}"></script>
@endsection
