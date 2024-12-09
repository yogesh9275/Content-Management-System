@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-warning text-white">
            <h3>Edit Image</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('galleries.update', $gallery->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" name="category" id="category" class="form-control" value="{{ $gallery->category }}" required>
                </div>

                <div class="mb-3">
                    <img src="{{ asset($gallery->path) }}" alt="Gallery Image" class="img-thumbnail">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('galleries.index') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-warning">Update Image</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
