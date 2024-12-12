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
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="mb-3">
            <label for="details" class="form-label">Details</label>
            <textarea name="details" id="details" rows="5" class="form-control" required>{{ old('details') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create News</button>
    </form>
</div>
@endsection
