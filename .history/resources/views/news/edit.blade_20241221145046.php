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
                <input type="text" name="title" id="title" class="form-control" value="{{ $news->title }}"
                    required>
            </div>


            <div class="mb-3 position-relative">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control">

                <!-- Cancel button for new image preview -->
                <span id="cancel-btn" class="position-absolute"
                    style="right: 0.40rem; bottom: 0.40rem; cursor: pointer; display: none;">
                    <x-simpleline-close class="table-icon text-danger" />
                </span>

                <!-- Error message for file size -->
                <div id="file-size-error" class="text-danger mt-2"></div>
            </div>

            <div class="mb-3">
                @if ($news->image_path)
                    <img src="{{ url( $news->image_path) }}" id="currentImagePreview" alt="News Image" style="width: 100%;"
                        class="mt-2">
                @endif

                <!-- New Image Preview -->
                <img id="newImagePreview" src="#" alt="New Image Preview"
                    style="display: none; max-width: 100%; height: auto;" class="mt-2">

            </div>

            <div class="mb-4 element-div" id="Long Text">
                <div class="form-label text-dark fw-bold">Details</div>
                <div id="editor">
                    <div id="edit">
                        {!! $news->details !!}
                    </div>
                </div>
            </div>


            <input type="hidden" name="details" id="details">

            <div class="d-flex justify-content-between">
                <a id="back-btn" href="{{ route('news.index') }}" class="btn btn-secondary">Back</a>
                <button id="update-btn" type="submit" class="btn btn-success">Update News</button>
            </div>
        </form>
    </div>
        <!-- Include Quill styles -->
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
        <!-- Include Quill script -->
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>


    <script>
        (function() {
            // Initialize Quill editor
            var quill = new Quill('#edit', {
                theme: 'snow', // Use the 'snow' theme, you can also use 'bubble'
                modules: {
                    toolbar: [
                        [{
                            'header': '1'
                        }, {
                            'header': '2'
                        }, {
                            'font': []
                        }],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        ['bold', 'italic', 'underline'],
                        ['link'],
                        ['blockquote'],
                        [{
                            'align': []
                        }],
                        [{
                            'color': []
                        }, {
                            'background': []
                        }],
                        ['code-block']
                    ]
                }
            });

            // On form submit, get the HTML content from Quill editor
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const longText = quill.root.innerHTML; // Get the HTML content from Quill editor

                // Check if the 'data-long-text' field exists, then send to 'data-long-text'
                if (document.getElementById('data-long-text')) {
                    document.getElementById('data-long-text').value = longText;
                } else {
                    // Otherwise send to the 'details' field
                    document.getElementById('details').value = longText;
                }
            });
        })();
    </script>
    <!-- JavaScript for dynamic behavior -->
    <script>
        const imageInput = document.getElementById("image");
        const newImagePreview = document.getElementById("newImagePreview");
        const currentImagePreview = document.getElementById("currentImagePreview");
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
                    newImagePreview.style.display = "none";
                    cancelBtn.style.display = "none";
                    return;
                }

                fileSizeError.textContent = "";
                const reader = new FileReader();
                reader.onload = function(e) {
                    newImagePreview.src = e.target.result;
                    newImagePreview.style.display = "block";
                    cancelBtn.style.display = "inline-block";
                };
                reader.readAsDataURL(file);

                // Hide current image preview if a new one is selected
                if (currentImagePreview) {
                    currentImagePreview.style.display = "none";
                }
            }
        });

        // Cancel the new image selection and reset preview
        cancelBtn.addEventListener("click", function() {
            imageInput.value = ""; // Reset file input
            newImagePreview.style.display = "none";
            cancelBtn.style.display = "none";

            // Show the original current image preview if available
            if (currentImagePreview) {
                currentImagePreview.style.display = "block";
            }
        });
    </script>
@endsection
