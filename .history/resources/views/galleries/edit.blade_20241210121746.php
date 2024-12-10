@extends('layouts.home')

@section('page')
    <div class="container mt-5">
        <h3 class="text-center text-warning mb-4">Edit Image</h3>

        <form action="{{ route('galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Category Select Dropdown -->
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select name="category" id="category" class="form-select" required>
                    <option value="News" {{ $gallery->category == 'News' ? 'selected' : '' }}>News</option>
                    <option value="Celebrations" {{ $gallery->category == 'Celebrations' ? 'selected' : '' }}>Celebrations</option>
                    <option value="Religional" {{ $gallery->category == 'Religional' ? 'selected' : '' }}>Religional</option>
                    <option value="Promotion" {{ $gallery->category == 'Promotion' ? 'selected' : '' }}>Promotion</option>
                </select>
            </div>

            <!-- Re-upload Image -->
            <div class="mb-3">
                <label for="path" class="form-label">Re-upload Image</label>
                <input type="file" name="path" id="path" class="form-control" accept="image/*">
            </div>

            <!-- Display current image in Flexbox Layout -->
            <div class="mb-3" style="display: flex; flex-direction: column; align-items: center;">
                <label for="current-image" class="form-label">Current Image</label>
                <img src="{{ asset($gallery->path) }}" alt="Gallery Image" class="img-thumbnail" id="current-image" style="max-width: 100%; height: auto;">
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('galleries.index') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-warning">Update Image</button>
            </div>
        </form>
    </div>
@endsection
