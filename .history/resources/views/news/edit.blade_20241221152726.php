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

        <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data" id="news-form">
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
                    <img src="{{ url($news->image_path) }}" id="currentImagePreview" alt="News Image" style="width: 100%;"
                        class="mt-2">
                @endif

                <!-- New Image Preview -->
                <img id="newImagePreview" src="#" alt="New Image Preview"
                    style="display: none; max-width: 100%; height: auto;" class="mt-2">

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
                <button id="update-btn" type="submit" class="btn btn-success">Update News</button>
            </div>
        </form>
    </div>
    <!-- JavaScript for dynamic behavior -->
    <script src="{{ asset('js/pages/news_edit.js') }}"></script>
@endsection
