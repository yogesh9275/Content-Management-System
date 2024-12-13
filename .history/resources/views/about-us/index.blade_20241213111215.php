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
                        <h5 class="card-title text-dark mb-3 fw-bold">{{ $element->element }}</h5>

                        @if ($element->element == 'Image')
                            <img src="{{ asset($element->data) }}" alt="Image" class="img-fluid rounded shadow-sm"
                                style="max-width: 100%; max-height: 20rem;">
                        @else
                            @php
                                $data = $element->data;

                                // Load the HTML into a DOMDocument
                                $dom = new DOMDocument();
                                libxml_use_internal_errors(true); // Suppress warnings for invalid HTML
                                $dom->loadHTML('<div>' . $data . '</div>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                                libxml_clear_errors();

                                // Extract only the first <p> element
                                $firstParagraph = '';
                                $paragraphs = $dom->getElementsByTagName('p');
                                if ($paragraphs->length > 0) {
                                    $firstParagraph = $dom->saveHTML($paragraphs->item(0));
                                }
                            @endphp

                            <p class="card-text text-muted">{!! $firstParagraph !!}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
