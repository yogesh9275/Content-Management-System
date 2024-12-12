@section('title', 'About Us')
@extends('layouts.home')

@section('page')
    <div class="container mt-5">
        <div class="shadow-sm p-4 rounded bg-white">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-3">
                <h3 class="mb-0 text-primary">About Us - Manage Elements</h3>
                <a id="Add-btn" href="{{ route('about-us.create') }}" class="btn btn-primary"><x-bi-plus class="Add-icon" />Add New Element</a>
            </div>

            @foreach ($elements as $element)
                <div class="py-4 border-bottom">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div class="content">
                            <h5 class="text-dark mb-3 fw-bold">{{ $element->element }}</h5>
                            @if($element->element == 'Image')
                                <img src="{{ asset($element->data) }}" alt="Image" class="img-fluid rounded shadow-sm" style="max-width: 100%; max-height: 20rem;">
                            @else
                                @php
                                    $data = $element->data;
                                    $firstParagraph = strtok($data, "\n"); // Extracts the first paragraph based on new lines
                                @endphp
                                <p class="text-muted">{{ $firstParagraph }}</p>
                            @endif
                        </div>
                        <div class="actions d-flex align-items-center gap-2">
                            <form action="{{ route('galleries.edit', $gallery->id) }}//{{ $element->id }}/edit" method="GET" class="d-inline">
                                <button type="submit" class="btn btn-warning btn-sm d-flex align-items-center">
                                    <x-simpleline-pencil class="icon-size" />
                                </button>
                            </form>
                            <form action="/about-us/{{ $element->id }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center">
                                    <x-simpleline-trash class="icon-size" />
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
