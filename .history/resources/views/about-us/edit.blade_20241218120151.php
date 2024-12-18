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
                            <option value="header" {{ $element->element == 'header' ? 'selected' : '' }}>Header</option>
                            <option value="paragraph" {{ $element->element == 'paragraph' ? 'selected' : '' }}>Paragraph
                            </option>
                            <option value="image" {{ $element->element == 'Image' ? 'selected' : '' }}>Image</option>
                            <option value="about-header" {{ $element->element == 'about-header' ? 'selected' : '' }}>About
                                Header
                            </option>
                            <option value="about-image" {{ $element->element == 'about-image' ? 'selected' : '' }}>About
                                Image</option>
                            <option value="2004" {{ $element->element == '2004' ? 'selected' : '' }}>2004</option>
                            <option value="2014" {{ $element->element == '2014' ? 'selected' : '' }}>2014</option>
                            <option value="2016" {{ $element->element == '2016' ? 'selected' : '' }}>2016</option>
                            <option value="2018" {{ $element->element == '2018' ? 'selected' : '' }}>2018</option>
                            <option value="2021" {{ $element->element == '2021' ? 'selected' : '' }}>2021</option>
                            <option value="2024" {{ $element->element == '2024' ? 'selected' : '' }}>2024</option>
                        </select>
                    </div>

                    <!-- Div for Header -->
                    <div class="mb-4 element-div" id="header" style="display:none;">
                        <label for="data-header" class="form-label text-dark fw-bold">Header Data</label>
                        <input type="text" class="form-control" name="data-header" id="data-header"
                            value="{{ $element->data }}">
                    </div>

                    <!-- Div for Header -->
                    <div class="mb-4 element-div" id="about-header" style="display:none;">
                        <label for="about-data-header" class="form-label text-dark fw-bold">Header Data</label>
                        <input type="text" class="form-control" name="about-data-header" id="about-data-header"
                            value="{{ $element->data }}">
                    </div>

                    <!-- Div for Paragraph -->
                    <div class="mb-4 element-div" id="paragraph" style="display:none;">
                        <label for="data-paragraph" class="form-label text-dark fw-bold">Paragraph Data</label>
                        <textarea class="form-control" name="data-paragraph" id="data-paragraph" rows="10">{{ $element->data }}</textarea>
                        <div id="word-count-error-Paragraph" class="text-danger" style="display: none;">Description exceeds
                            the word
                            limit. Please shorten it.</div>
                        <div id="word-count-display-Paragraph" class="mt-2 text-muted">Words: 0/250</div>
                    </div>

                    <!-- Special Year Divs -->
                    <div class="mb-4 element-div" id="2004" style="display:none;">
                        <label for="data-paragraph-2004" class="form-label text-dark fw-bold">Paragraph for 2004</label>
                        <textarea class="form-control" name="data-paragraph-2004" id="data-paragraph-2004" rows="10">{{ $element->data }}</textarea>
                        <div id="word-count-error-2004" class="text-danger" style="display: none;">Description exceeds the
                            word
                            limit. Please shorten it.</div>
                        <div id="word-count-display-2004" class="mt-2 text-muted">Words: 0/250</div>
                    </div>

                    <div class="mb-4 element-div" id="2014" style="display:none;">
                        <label for="data-paragraph-2014" class="form-label text-dark fw-bold">Paragraph for 2014</label>
                        <textarea class="form-control" name="data-paragraph-2014" id="data-paragraph-2014" rows="10">{{ $element->data }}</textarea>
                        <div id="word-count-error-2014" class="text-danger" style="display: none;">Description exceeds the
                            word
                            limit. Please shorten it.</div>
                        <div id="word-count-display-2014" class="mt-2 text-muted">Words: 0/250</div>
                    </div>

                    <div class="mb-4 element-div" id="2016" style="display:none;">
                        <label for="data-paragraph-2016" class="form-label text-dark fw-bold">Paragraph for 2016</label>
                        <textarea class="form-control" name="data-paragraph-2016" id="data-paragraph-2016" rows="10">{{ $element->data }}</textarea>
                        <div id="word-count-error-2016" class="text-danger" style="display: none;">Description exceeds the
                            word
                            limit. Please shorten it.</div>
                        <div id="word-count-display-2016" class="mt-2 text-muted">Words: 0/250</div>
                    </div>

                    <div class="mb-4 element-div" id="2018" style="display:none;">
                        <label for="data-paragraph-2018" class="form-label text-dark fw-bold">Paragraph for 2018</label>
                        <textarea class="form-control" name="data-paragraph-2018" id="data-paragraph-2018" rows="10">{{ $element->data }}</textarea>
                        <div id="word-count-error-2018" class="text-danger" style="display: none;">Description exceeds
                            the word
                            limit. Please shorten it.</div>
                        <div id="word-count-display-2018" class="mt-2 text-muted">Words: 0/250</div>
                    </div>

                    <div class="mb-4 element-div" id="2021" style="display:none;">
                        <label for="data-paragraph-2021" class="form-label text-dark fw-bold">Paragraph for 2021</label>
                        <textarea class="form-control" name="data-paragraph-2021" id="data-paragraph-2021" rows="10">{{ $element->data }}</textarea>
                        <div id="word-count-error-2021" class="text-danger" style="display: none;">Description exceeds
                            the word
                            limit. Please shorten it.</div>
                        <div id="word-count-display-2021" class="mt-2 text-muted">Words: 0/250</div>
                    </div>

                    <div class="mb-4 element-div" id="2024" style="display:none;">
                        <label for="data-paragraph-2024" class="form-label text-dark fw-bold">Paragraph for 2024</label>
                        <textarea class="form-control" name="data-paragraph-2024" id="data-paragraph-2024" rows="10">{{ $element->data }}</textarea>
                        <div id="word-count-error-2024" class="text-danger" style="display: none;">Description exceeds
                            the word
                            limit. Please shorten it.</div>
                        <div id="word-count-display-2024" class="mt-2 text-muted">Words: 0/250</div>
                    </div>


                    <!-- Div for Image -->
                    <div class="mb-4 element-div position-relative" id="image"
                        style="{{ $element->element == 'image' ? 'display:block;' : 'display:none;' }}">
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

                    <!-- Div for Image -->
                    <div class="mb-4 element-div position-relative" id="about-image"
                        style="{{ $element->element == 'about-image' ? 'display:block;' : 'display:none;' }}">
                        <label for="about-data-image" class="form-label text-dark fw-bold">Upload Image</label>

                        <!-- File input to accept image files -->
                        <input type="file" class="form-control" name="about-data-image" id="about-data-image"
                            accept="image/*">

                        <!-- X button inside the input field, hidden by default -->
                        <span id="about-cancel-btn" class="position-absolute"
                            style="right: 0.40rem; bottom: 0.40rem; cursor: pointer; display:none;">
                            <x-simpleline-close class="table-icon text-danger" />
                        </span>

                        <!-- Error message for file size -->
                        <div id="about-file-size-error" class="text-danger mt-2"></div>
                    </div>

                    <!-- Image Preview -->
                    <div class="mt-3" id="image-preview"
                        style="display: {{ ($element->element == 'image' || $element->element == 'about-image') && $element->data ? 'block;' : 'none;' }}">
                        <img id="preview-img" src="{{ asset($element->data) }}" class="img-thumbnail mb-2"
                            alt="Image Preview" style="max-width: 50%; max-height: 50%;">
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

    <!-- Include the external JavaScript file -->
    <script src="{{ asset('js/pages/about_edit.js') }}"></script>
    <script>
        document.getElementById('edit-form').addEventListener('submit', function(event) {
            const selectedElement = document.getElementById('element').value;
            const form = event.target;

            // Gather all form fields
            const allFields = form.querySelectorAll('.element-div, [name]');

            allFields.forEach(field => {
                // Get the field's name and associated element id
                const fieldName = field.name || field.id;

                // Check if the field belongs to the selected element
                if (!fieldName.includes(selectedElement) && fieldName !== 'element') {
                    // Remove unrelated fields from the form
                    field.disabled = true;
                }
            });
        });
    </script>
@endsection
