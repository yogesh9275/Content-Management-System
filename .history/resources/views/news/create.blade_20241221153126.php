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

        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data" id="news-form">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="mb-3 position-relative">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control">

                <!-- Cancel button inside the input field, hidden by default -->
                <span id="cancel-btn" class="position-absolute"
                    style="right: 0.40rem; bottom: 0.40rem; cursor: pointer; display: none;">
                    <x-simpleline-close class="table-icon text-danger" />
                </span>

                <!-- Error message for file size -->
                <div id="file-size-error" class="text-danger mt-2"></div>
            </div>

            <!-- Image preview -->
            <div class="mt-3" id="image-preview" style="display: none;">
                <img id="imagePreview" src="#" alt="Image Preview" class="img-thumbnail mb-2"
                     style="max-width: 100%; max-height: 100%;">
            </div>

            <div class="mb-4 element-div" id="Long Text">
                <div class="form-label text-dark fw-bold">Details</div>
                <div id="editor">
                    {!! $news->details !!}
                </div>
            </div>


            <input type="hidden" name="details" id="details">

            <div class="d-flex justify-content-between">
                <a id="back-btn" href="{{ route('news.index') }}" class="btn btn-secondary">Back</a>
                <button id="create-btn" type="submit" class="btn btn-primary">Create News</button>
            </div>
        </form>
    </div>

    <script>
        const imageInput = document.getElementById("image");
        const imagePreview = document.getElementById("image-preview");
        const previewImg = document.getElementById("imagePreview");
        const cancelBtn = document.getElementById("cancel-btn");
        const fileSizeError = document.getElementById("file-size-error");

        imageInput.addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const fileSize = file.size / 1024 / 1024; // size in MB
                const maxSize = 2; // 2 MB

                // Check file size
                if (fileSize > maxSize) {
                    fileSizeError.textContent = "File size exceeds 2MB. Please upload a smaller image.";
                    imageInput.value = ""; // clear the file input
                    imagePreview.style.display = "none";
                    cancelBtn.style.display = "none";
                    return;
                }

                fileSizeError.textContent = "";
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    imagePreview.style.display = "block";
                    cancelBtn.style.display = "inline-block";
                };
                reader.readAsDataURL(file);
            }
        });

        // Cancel the image selection and hide preview
        cancelBtn.addEventListener("click", function() {
            imageInput.value = ""; // Reset file input
            imagePreview.style.display = "none";
            cancelBtn.style.display = "none";
        });
    </script>
@endsection
