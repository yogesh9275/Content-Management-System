@extends('layoutshome')

@section('page')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3>Gallery Management</h3>
        </div>
        <div class="card-body">
            <a href="{{ route('galleries.create') }}" class="btn btn-success mb-3">Add New Image</a>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row">
                @forelse ($galleries as $gallery)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset($gallery->path) }}" class="card-img-top" alt="Gallery Image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $gallery->category }}</h5>
                                <a href="{{ route('galleries.edit', $gallery->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('galleries.destroy', $gallery->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">No images found in the gallery.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
