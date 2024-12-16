@section('title', 'Edit Home Page Element')
@extends('layouts.home')

@section('page')
<div class="container my-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3 class="text-center text-primary mb-4">Edit About Us Element</h3>
            <form action="{{ route('homepage.update', $homePage->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Element Type Selector -->
                <div class="mb-4">
                    <label for="element" class="form-label fw-bold">Element Type</label>
                    <select class="form-select" id="element" name="element" onchange="toggleFields()" required>
                        <option value="Header" {{ $homePage->element == 'Header' ? 'selected' : '' }}>Header</option>
                        <option value="Paragraph" {{ $homePage->element == 'Paragraph' ? 'selected' : '' }}>Paragraph</option>
                        <option value="Image" {{ $homePage->element == 'Image' ? 'selected' : '' }}>Image</option>
                        <option value="Long Text" {{ $homePage->element == 'Long Text' ? 'selected' : '' }}>Long Text</option>
                    </select>
                </div>

                <!-- Header Input -->
                <div class="mb-4 field-group" id="header-field" style="display: none;">
                    <label for="header-data" class="form-label fw-bold">Header Text</label>
                    <input type="text" id="header-data" name="header_data" class="form-control" value="{{ $homePage->element == 'Header' ? $homePage->data : '' }}">
                </div>

                <!-- Paragraph Input -->
                <div class="mb-4 field-group" id="paragraph-field" style="display: none;">
                    <label for="paragraph-data" class="form-label fw-bold">Paragraph Text</label>
                    <textarea id="paragraph-data" name="paragraph_data" class="form-control" rows="4">{{ $homePage->element == 'Paragraph' ? $homePage->data : '' }}</textarea>
                </div>

                <!-- Image Input -->
                <div class="mb-4 field-group" id="image-field" style="display: none;">
                    <label for="image-data" class="form-label fw-bold">Upload Image</label>
                    <input type="file" id="image-data" name="image_data" class="form-control" accept="image/*">

                    <div id="image-preview" class="mt-3" style="display: {{ $homePage->element == 'Image' && $homePage->data ? 'block' : 'none' }}">
                        <img src="{{ $homePage->element == 'Image' && $homePage->data ? asset($homePage->data) : '' }}" id="preview-img" class="img-thumbnail" style="max-width: 100%; height: auto;">
                    </div>
                </div>

                <!-- Long Text Input -->
                <div class="mb-4 field-group" id="long-text-field" style="display: none;">
                    <label for="long-text-data" class="form-label fw-bold">Long Text</label>
                    <textarea id="long-text-data" name="long_text_data" class="form-control" rows="6">{{ $homePage->element == 'Long Text' ? $homePage->data : '' }}</textarea>
                </div>

                <div class="text-center">
                    <a href="{{ route('homepage.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const elementSelect = document.getElementById('element');
        const fieldGroups = {
            'Header': document.getElementById('header-field'),
            'Paragraph': document.getElementById('paragraph-field'),
            'Image': document.getElementById('image-field'),
            'Long Text': document.getElementById('long-text-field')
        };

        function toggleFields() {
            const selected = elementSelect.value;
            Object.keys(fieldGroups).forEach(key => {
                fieldGroups[key].style.display = key === selected ? 'block' : 'none';
            });
        }

        toggleFields(); // Set initial state based on the selected element type

        // Image preview
        const imageInput = document.getElementById('image-data');
        const previewImg = document.getElementById('preview-img');

        imageInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImg.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endsection
