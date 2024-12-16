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

            <!-- Media Text Field (Instead of Title) -->
            <div class="mb-3">
                <label for="media" class="form-label">Media</label>
                <input type="text" name="media" id="media" class="form-control" value="{{ old('media') }}" required>
            </div>

            <!-- Link Field -->
            <div class="mb-3">
                <label for="links" class="form-label">Links</label>
                <input type="url" name="links" id="links" class="form-control" value="{{ old('links') }}" required>
            </div>

            <!-- Image Upload Field -->
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

            <div class="mb-3">
                <div class="form-label">Details</div>
                <div id="editor">
                    <div id="edit">
                    </div>
                </div>
            </div>

            <input type="hidden" name="details" id="details">

            <div class="d-flex justify-content-between">
                <a id="back-btn" href="{{ route('news.index') }}" class="btn btn-secondary">Back</a>
                <button id="create-btn" type="submit" class="btn btn-primary">Create News</button>
            </div>
        </form>
    </div>
@endsection
