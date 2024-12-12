@section('title', 'Edit News')
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

            <!-- Replace the textarea with a div for Summernote -->
            <div class="mb-3">
                <label for="details" class="form-label">Details</label>
                <div id="details" class="summernote" name="details" required>{{ $news->details }}</div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('news.index') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-success">Update News</button>
            </div>
        </form>
    </div>

    <!-- JavaScript for dynamic behavior -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Summernote for rich text editor
            $('#details').summernote({
                height: 300,  // Set the height of the editor
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontname', 'fontsize', 'color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                fontNames: ['Arial', 'Courier', 'Georgia', 'Impact'], // Customize fonts
                fontSizes: ['8', '10', '12', '14', '16', '18', '20']  // Customize font sizes
            });

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
                        if (currentImagePreview) currentImagePreview.style.display = 'none'; // Hide current image
                    };
                    reader.readAsDataURL(file);
                } else {
                    newImagePreview.style.display = 'none';
                    if (currentImagePreview) currentImagePreview.style.display = 'block'; // Show current image again
                }
            });
        });
    </script>
@endsection
