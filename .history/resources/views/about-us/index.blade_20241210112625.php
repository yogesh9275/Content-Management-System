@extends('layouts.home')

@section('page')
    <div class="container mt-5">
        <div class="shadow-sm p-4 rounded bg-white">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                <h3 class="mb-0 text-primary">About Us - Manage Elements</h3>
                <a href="/about-us/create" class="btn btn-primary">Add New Element</a>
            </div>

            @foreach ($elements as $element)
                <div class="py-4 border-bottom">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="content">
                            <h5 class="text-secondary mb-3">{{ $element->element }}</h5>
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
                        <div class="actions">
                            <form action="/about-us/{{ $element->id }}/edit" method="GET" class="d-inline">
                                <button type="submit" class="btn btn-warning btn-sm mb-2"><x-simpleline-pencil class="icon-size" /></button>
                            </form>
                            <form action="/about-us/{{ $element->id }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><x-simpleline-trash /></button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
