@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h3>Add New Image</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" name="category" id="category" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="path" class="form-label">Upload Image</label>
                    <input type="file" name="path" id="path" class="form-control" accept="image/*" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('galleries.index') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-success">Add Image</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
