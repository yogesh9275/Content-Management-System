@section('title', 'Edit Home Page Element')
@extends('layouts.home')

@section('page')
<div class="container my-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3 class="text-center text-primary mb-4">Edit Home Page Element</h3>
            <form action="{{ route('homepage.update', $homePage->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Element Type Selector -->
                <div class="mb-4">
                    <label for="element" class="form-label fw-bold">Element Type</label>
                    <select class="form-select" id="element" name="element" onchange="toggleFields()" required>
                        <option value="Title" {{ $homePage->element == 'Title' ? 'selected' : '' }}>Title</option>
                        <option value="Description" {{ $homePage->element == 'Description' ? 'selected' : '' }}>Description</option>
                        <option value="Image" {{ $homePage->element == 'Image' ? 'selected' : '' }}>Image</option>
                    </select>
                </div>

                <!-- Title Input -->
                <div class="mb-4 field-group" id="title-field" style="display: {{ $homePage->element == 'Title' ? 'block' : 'none' }}">
                    <label for="data-title" class="form-label fw-bold">Title</label>
                    <input type="text" id="data-title" name="data-title" class="form-control" value="{{ $homePage->element == 'Title' ? $homePage->data : '' }}">
                </div>

                <!-- Description Input -->
                <div class="mb-4 field-group" id="description-field" style="display: {{ $homePage->element == 'Description' ? 'block' : 'none' }}">
                    <label for="data-description" class="form-label fw-bold">Description</label>
                    <textarea id="data-description" name="data-description" class="form-control" rows="5">{{ $homePage->element == 'Description' ? $homePage->data : '' }}</textarea>
                </div>

                <!-- Image Input -->
                <div class="mb-4 field-group" id="image-field" style="display: {{ $homePage->element == 'Image' && $homePage->data ? 'block' : 'none' }}">
                    <label for="data-image" class="form-label fw-bold">Upload New Image (if any)</label>
                    <input type="file" id="data-image" name="data-image" class="form-control" accept="image/*">

                    @if ($homePage->element == 'Image' && $homePage->data)
                        <div id="image-preview" class="mt-3" style="display: block;">
                            <img src="{{ asset($homePage->data) }}" id="preview-img" class="img-thumbnail" style="max-width: 100%; height: auto;">
                        </div>
                    @endif
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
            'Title': document.getElementById('title-field'),
            'Description': document.getElementById('description-field'),
            'Image': document.getElementById('image-field')
        };

        function toggleFields() {
            const selected = elementSelect.value;
            Object.keys(fieldGroups).forEach(key => {
                fieldGroups[key].style.display = key === selected ? 'block' : 'none';
            });
        }

        toggleFields(); // Set initial state based on the selected element type

        // Image preview handling (if any image is uploaded)
        const imageInput = document.getElementById('data-image');
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
