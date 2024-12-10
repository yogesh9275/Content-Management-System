@extends('layouts.home')

@section('page')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom">
        <h3 class="text-center mb-4 flex-grow-1">Gallery Management</h3>
        <a href="{{ route('galleries.create') }}" class="btn btn-success mb-3">Add New Image</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse ($galleries as $gallery)
            <div class="col-md-4 mb-4">
                <!-- Grid Item Card -->
                <div class="card h-100 position-relative">
                    <img src="{{ asset($gallery->path) }}" class="card-img-top" alt="Gallery Image" style="object-fit: cover; height: 200px;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $gallery->category }}</h5>

                        <!-- Action Buttons (Edit & Delete) -->
                        <div class="actions d-flex align-items-center gap-2 mt-auto position-absolute top-50 start-50 translate-middle d-none">
                            <form action="{{ route('galleries.edit', $gallery->id) }}" method="GET" class="d-inline">
                                <button type="submit" class="btn btn-warning btn-sm d-flex align-items-center">
                                    <x-simpleline-pencil class="icon-size" />
                                </button>
                            </form>
                            <form action="{{ route('galleries.destroy', $gallery->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center">
                                    <x-simpleline-trash class="icon-size" />
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No images found in the gallery.</p>
        @endforelse
    </div>
</div>

@endsection

@section('css')
<style>
    .card {
        position: relative;
        overflow: hidden;
    }

    .card:hover .actions {
        display: flex;
    }
</style>
@endsection
