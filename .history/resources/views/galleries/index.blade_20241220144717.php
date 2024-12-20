@section('title', 'Gallery Management')
@extends('layouts.home')

@section('page')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center border-bottom pb-3">
            <h3 class="mb-0 text-primary">Gallery Management</h3>
            <a id="Add-btn" href="{{ route('galleries.create') }}" class="btn btn-primary">
                <x-bi-plus class="Add-icon" />Add New Image
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row my-4">
            @forelse ($galleries as $gallery)
                <div class="col-md-4 mb-4">
                    <!-- Grid Item Card -->
                    <div class="card h-100 gallery-card" onmouseover="showCardBody(this)" onmouseout="hideCardBody(this)"
                        style="position: relative;">
                        <img src="{{ url( . $gallery->path) }}" class="card-img-top" alt="Gallery Image"
                            style="object-fit: cover; height: 250px;">
                        <div class="card-body d-flex flex-column"
                            style="position: absolute; top: 50%; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.5); opacity: 0; transition: opacity 0.3s ease;">
                            <h5 class="card-title text-white">{{ ucwords(str_replace('-', ' ', $gallery->category)) }}</h5>

                            <!-- Action Buttons (Edit & Delete) -->
                            <div class="actions d-flex align-items-center gap-2 mt-auto">
                                <form action="{{ route('galleries.edit', $gallery->id) }}" method="GET" class="d-inline">
                                    <button id="edit-btn" type="submit" class="btn btn-warning btn-sm d-flex align-items-center">
                                        <x-simpleline-pencil class="icon-size" />
                                    </button>
                                </form>
                                <form action="{{ route('galleries.destroy', $gallery->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button id="delete-btn" type="submit" class="btn btn-danger btn-sm d-flex align-items-center">
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
            opacity: 0;
            /* Hide content initially */
            transition: opacity 0.3s ease;
            /* Smooth transition for visibility */
        }

        .card-body img {
            transition: transform 0.3s ease;
            /* Smooth image transform */
        }

        .card:hover .card-body img {
            transform: scale(1.1);
            /* Slight zoom effect on image */
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
