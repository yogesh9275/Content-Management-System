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
                <div class="card h-100 gallery-card" onmouseover="showCardBody(this)" onmouseout="hideCardBody(this)" style="position: relative;">
                    <img src="{{ asset($gallery->path) }}" class="card-img-top" alt="Gallery Image" style="object-fit: cover; height: 200px;">
                    <div class="card-body d-flex flex-column" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.5); opacity: 0; transition: opacity 0.3s ease;">
                        <h5 class="card-title text-white">{{ $gallery->category }}</h5>

                        <!-- Action Buttons (Edit & Delete) -->
                        <div class="actions d-flex align-items-center gap-2 mt-auto">
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

<style>
    .card {
        position: relative;
        overflow: hidden;
    }

    .card-body {
        opacity: 0; /* Hide content initially */
        transition: opacity 0.3s ease; /* Smooth transition for visibility */
    }

    .card-body img {
        transition: transform 0.3s ease; /* Smooth image transform */
    }

    .card:hover .card-body img {
        transform: scale(1.1); /* Slight zoom effect on image */
    }
</style>

<script>
    // Show the card body when the card is hovered
    function showCardBody(card) {
        const cardBody = card.querySelector('.card-body');
        cardBody.style.opacity = 1;
    }

    // Hide the card body when the mouse leaves the card
    function hideCardBody(card) {
        const cardBody = card.querySelector('.card-body');
        cardBody.style.opacity = 0;
        car
    }
</script>
@endsection
