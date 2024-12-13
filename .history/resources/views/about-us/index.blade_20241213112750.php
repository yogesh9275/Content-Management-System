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
                <div class="card my-4" style="width: 100%;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center border p-3 rounded">
                            <h5 class="card-title text-dark fw-bold" style="margin-bottom: 0">{{ $element->element }}</h5>
                            <div class="d-flex justify-content-end gap-2">
                                <form action="{{ route('about-us.edit', $element->id) }}" method="GET" class="d-inline">
                                    <button id="edit-btn" type="submit" class="btn btn-warning btn-sm d-flex align-items-center">
                                        <x-simpleline-pencil class="icon-size" />
                                    </button>
                                </form>
                                <form action="{{ route('about-us.destroy', $element->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button id="delete-btn" type="submit" class="btn btn-danger btn-sm d-flex align-items-center">
                                        <x-simpleline-trash class="icon-size" />
                                    </button>
                                </form>
                            </div>
                        </div>


                        @if ($element->element == 'Image')
                            <img src="{{ asset($element->data) }}" alt="Image" class="img-fluid rounded shadow-sm mt-3"
                                style="max-width: 100%; max-height: 100%;">
                        @else
                        @php
                        $data = $element->data;
                        $isHTML = false;

                        // Load the HTML into a DOMDocument
                        $dom = new DOMDocument();
                        libxml_use_internal_errors(true); // Suppress warnings for invalid HTML
                        $dom->loadHTML('<div>' . $data . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                        libxml_clear_errors();

                        // Check for the presence of any HTML tags
                        $isHTML = $dom->getElementsByTagName('*')->length > 0;

                        // Extract only the first <p> element if it is HTML
                        $firstParagraph = '';
                        if ($isHTML) {
                            $paragraphs = $dom->getElementsByTagName('p');
                            if ($paragraphs->length > 0) {
                                $firstParagraph = $dom->saveHTML($paragraphs->item(0));
                            }
                        }
                    @endphp

                    @if ($isHTML && !empty($firstParagraph))
                        <p class="card-text text-muted">{!! $firstParagraph !!}</p>
                    @else
                        <p class="card-text text-muted">{{ $data }}</p>
                    @endif
                @endif
                    
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
