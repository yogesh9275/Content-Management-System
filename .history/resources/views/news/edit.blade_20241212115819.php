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
            <input type="text" name="title" id="title" class="form-control" value="{{ $news->title }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control">
            @if ($news->image_path)
                <img src="{{ asset($news->image_path) }}" id="currentImagePreview" alt="News Image" style="width: 100%;" class="mt-2">
            @endif
            <!-- New Image Preview -->
            <img id="newImagePreview" src="#" alt="New Image Preview" style="display: none; max-width: 100%; height: auto;" class="mt-2">
        </div>

        <div class="mb-3">
            <label for="details" class="form-label">Details</label>
            <textarea name="details" id="details" rows="5" class="form-control" required>{{ $news->details }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update News</button>
    </form>
</div>

<!-- JavaScript for dynamic behavior -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Image preview for new uploads
        const imageInput = document.getElementById('image');
        const newImagePreview = document.getElementById('newImagePreview');
        const currentImagePreview = document.getElementById('currentImagePreview');

        imageInput.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    newImagePreview.src = e.target.result;
                    newImagePreview.style.display = 'block';
                    if (currentImagePreview) currentImagePreview.style.display = 'none'; // Hide current image
                };
                reader.readAsDataURL(file);
            } else {
                newImagePreview.style.display = 'none';
                if (currentImagePreview) currentImagePreview.style.display = 'block'; // Show current image again
            }
        });

        // Dynamic textarea height
        const detailsTextarea = document.getElementById('details');
        detailsTextarea.addEventListener('input', function () {
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
