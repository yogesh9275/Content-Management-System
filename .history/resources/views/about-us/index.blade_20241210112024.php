@extends('layouts.home')

@section('page')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h3 class="mb-0">About Us - Manage Elements</h3>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <h5 class="mb-0">Elements List</h5>
                    <a href="/about-us/create" class="btn btn-primary">Add New Element</a>
                </div>
                <div class="row">
                    @foreach ($elements as $element)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title"><strong>{{ $element->element }}</strong></h5>
                                    @if($element->element == 'Image')
                                        <!-- Display image -->
                                        <img src="{{ asset($element->data) }}" alt="Image" class="img-fluid mt-3" style="max-height: 15rem; object-fit: cover;">
                                    @else
                                        @php
                                            $data = $element->data;
                                            $firstParagraph = strtok($data, "\n"); // Extracts the first paragraph
                                        @endphp
                                        <p class="card-text mt-3">{{ $firstParagraph }}</p>
                                    @endif
                                </div>
                                <div class="card-footer bg-light d-flex justify-content-between">
                                    <a href="/about-us/{{ $element->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="/about-us/{{ $element->id }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
