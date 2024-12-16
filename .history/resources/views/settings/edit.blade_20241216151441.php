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

            <!-- Media Dropdown Field -->
            <div class="mb-3">
                <label for="media" class="form-label">Select Media</label>
                <select name="media" id="media" class="form-control" required>
                    <option value="">Select Media</option>
                    <option value="facebook" {{ old('media', $news->media) == 'facebook' ? 'selected' : '' }}>Facebook</option>
                    <option value="instagram" {{ old('media', $news->media) == 'instagram' ? 'selected' : '' }}>Instagram</option>
                    <option value="twitter" {{ old('media', $news->media) == 'twitter' ? 'selected' : '' }}>Twitter</option>
                    <option value="threads" {{ old('media', $news->media) == 'threads' ? 'selected' : '' }}>Threads</option>
                </select>
            </div>

            <!-- Link Field -->
            <div class="mb-3">
                <label for="links" class="form-label">Links</label>
                <input type="url" name="links" id="links" class="form-control" value="{{ old('links', $news->links) }}" required>
            </div>

            <!-- Current Image and Image Preview Handling -->
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

            <!-- Existing Image Display (if any) -->
            <div class="mb-3">
                @if ($news->image_path)
                    <img src="{{ asset($news->image_path) }}" id="currentImagePreview" alt="News Image" style="width: 100%;" class="mt-2">
                @endif
                <!-- New Image Preview -->
                <img id="newImagePreview" src="#" alt="New Image Preview" style="display: none; max-width: 100%; height: auto;" class="mt-2">
            </div>

            <!-- Long Text/Details Section -->
            <div class="mb-4 element-div" id="Long Text">
                <div class="form-label text-dark fw-bold">Details</div>
                <div id="editor">
                    <div id="edit">
                        {!! old('details', $news->details) !!}
                    </div>
                </div>
            </div>

            <input type="hidden" name="details" id="details">

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between">
                <a id="back-btn" href="{{ route('news.index') }}" class="btn btn-secondary">Back</a>
                <button id="update-btn" type="submit" class="btn btn-success">Update News</button>
            </div>
        </form>
    </div>

    
@endsection
