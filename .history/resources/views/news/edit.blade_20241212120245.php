@extends('layouts.home')

@section('page')
    <div class="container mt-4">
        <h1 class="mb-4">Edit News</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $news->title }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @if ($news->image_path)
                    <img src="{{ asset($news->image_path) }}" id="currentImagePreview" alt="News Image" style="width: 100%;"
                        class="mt-2">
                @endif
                <!-- New Image Preview -->
                <img id="newImagePreview" src="#" alt="New Image Preview"
                    style="display: none; max-width: 100%; height: auto;" class="mt-2">
            </div>

            <div class="mb-3">
                <label for="details" class="form-label">Details</label>
                <textarea name="details" id="details" rows="25" class="form-control" required>{{ $news->details }}</textarea>
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('galleries.index') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-warning">Update Image</button>
            </div>

            
        </form>
    </div>

    <!-- JavaScript for dynamic behavior -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Image preview for new uploads
            const imageInput = document.getElementById('image');
            const newImagePreview = document.getElementById('newImagePreview');
            const currentImagePreview = document.getElementById('currentImagePreview');

            imageInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        newImagePreview.src = e.target.result;
                        newImagePreview.style.display = 'block';
                        if (currentImagePreview) currentImagePreview.style.display =
                        'none'; // Hide current image
                    };
                    reader.readAsDataURL(file);
                } else {
                    newImagePreview.style.display = 'none';
                    if (currentImagePreview) currentImagePreview.style.display =
                    'block'; // Show current image again
                }
            });

            // Dynamic textarea height
            const detailsTextarea = document.getElementById('details');

            // Set default to 25 rows initially
            detailsTextarea.style.height = `${25 * parseFloat(getComputedStyle(detailsTextarea).lineHeight)}px`;

            detailsTextarea.addEventListener('input', function() {
                this.style.height = 'auto'; // Reset height to auto to calculate the actual content height
                const scrollHeight = this.scrollHeight;
                const minHeight = 5 * parseFloat(getComputedStyle(this).lineHeight); // Minimum 5 rows
                const maxHeight = 25 * parseFloat(getComputedStyle(this).lineHeight); // Maximum 25 rows

                if (scrollHeight < minHeight) {
                    this.style.height = `${minHeight}px`; // Set to minimum height
                } else if (scrollHeight > maxHeight) {
                    this.style.height = `${maxHeight}px`; // Set to maximum height
                } else {
                    this.style.height = `${scrollHeight}px`; // Adjust to fit content
                }
            });

        });
    </script>
@endsection
