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
                            <option value="{{$element->element}}" {{ $element->element == 'Header' ? 'selected' : '' }}>Header</option>
                            <option value="{{$element->element}}" {{ $element->element == 'Paragraph' ? 'selected' : '' }}>Paragraph
                            </option>
                            <option value="{{$element->element}}" {{ $element->element == 'Image' ? 'selected' : '' }}>Image</option>
                            <option value="{{$element->element}}" {{ $element->element == 'Long Text' ? 'selected' : '' }}>Long Text
                            </option>
                            <option value="{{$element->element}}" {{ $element->element == '2004' ? 'selected' : '' }}>Image</option>
                            <option value="{{$element->element}}" {{ $element->element == '2016' ? 'selected' : '' }}>Image</option>
                            <option value="{{$element->element}}" {{ $element->element == '2018' ? 'selected' : '' }}>Image</option>
                            <option value="{{$element->element}}" {{ $element->element == '2021' ? 'selected' : '' }}>Image</option>
                            <option value="{{$element->element}}" {{ $element->element == '2024' ? 'selected' : '' }}>Image</option>
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
                            src="{{ asset($element->data) }}"
                            class="img-thumbnail mb-2" alt="Image Preview" style="max-width: 100%; max-height: 100%;">
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
@endsection
