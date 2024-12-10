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
                <ul class="list-group">
                    @foreach ($elements as $element)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column">
                                <strong>{{ $element->element }}:</strong>
                                <!-- Check if the element type is 'Image' -->
                                @if($element->element == 'Image')
                                    <!-- Display image using the URL stored in $data -->
                                    <img src="{{ asset($element->data) }}" alt="Image" class="img-fluid" style="max-height: 25rem;">
                                @else
                                    @php
                                        $data = $element->data;
                                        $firstParagraph = strtok($data, "\n"); // Extracts the first paragraph based on new lines
                                    @endphp
                                    <p>{{ $firstParagraph }}</p>
                                @endif
                            </div>
                            <div class="d-flex flex-column">
                                <a href="/about-us/{{ $element->id }}/edit" class="btn btn-warning btn-sm mb-2">Edit</a>
                                <form action="/about-us/{{ $element->id }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endsection
