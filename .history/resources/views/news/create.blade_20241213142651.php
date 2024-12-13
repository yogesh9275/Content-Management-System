@section('title', 'Add News')
@extends('layouts.home')

@section('page')
    <div class="container mt-4">
        <h1 class="mb-4">Create News</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control">
                <!-- X button inside the input field, hidden by default -->
                <span id="cancel-btn" class="position-absolute"
                    style="right: 0.40rem; bottom: 0.40rem; cursor: pointer; display:none;">
                    <x-simpleline-close class="table-icon text-danger" />
                </span>

                <!-- Error message for file size -->
                <div id="file-size-error" class="text-danger mt-2"></div>
                <!-- Image preview -->
                <img id="imagePreview" src="#" alt="Image Preview" class="mt-3"
                    style="display: none; max-width: 100%; height: auto;">
            </div>

            <div class="mb-3">
                <div class="form-label">Details</div>
                <div id="editor">
                    <div id="edit">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a id="back-btn" href="{{ route('news.index') }}" class="btn btn-secondary">Back</a>
                <button id="create-btn" type="submit" class="btn btn-primary">Create News</button>
            </div>

        </form>
    </div>

    <!-- JavaScript for dynamic behavior -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Image preview
            const imageInput = document.getElementById('image');
            const imagePreview = document.getElementById('imagePreview');
            imageInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.style.display = 'none';
                }
            });

            // Dynamic textarea height
            const detailsTextarea = document.getElementById('details');
            detailsTextarea.addEventListener('input', function() {
                this.style.height = 'auto'; // Reset height to auto
                const scrollHeight = this.scrollHeight;
                const maxHeight = 25 * parseFloat(getComputedStyle(this).lineHeight); // Max rows 25
                if (scrollHeight < maxHeight) {
                    this.style.height = scrollHeight + 'px'; // Adjust to fit content
                } else {
                    this.style.height = maxHeight + 'px'; // Set to max height
                }
            });
        });
    </script>
@endsection
