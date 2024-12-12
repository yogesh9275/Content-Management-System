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
                <img src="{{ asset('storage/' . $news->image_path) }}" alt="News Image" style="width: 100px;" class="mt-2">
            @endif
        </div>
        <div class="mb-3">
            <label for="details" class="form-label">Details</label>
            <textarea name="details" id="details" rows="5" class="form-control" required>{{ $news->details }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Update News</button>
    </form>
</div>
@endsection
