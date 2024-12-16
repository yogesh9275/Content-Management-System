@section('title', 'Home Page')
@extends('layouts.home')

@section('page')
    <div class="container mt-5">
        <div class="shadow-sm p-4 rounded bg-white">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-3">
                <h3 class="mb-0 text-primary">Home - Manage Elements</h3>
                <a id="Add-btn" href="{{ route('homepage.create') }}" class="btn btn-primary"><x-bi-plus class="Add-icon" />Add New Element</a>
            </div>

            @foreach ($homePages as $homePage)
                <div class="card my-4" style="width: 100%;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center border p-3 rounded">
                            <h5 class="card-title text-dark fw-bold" style="margin-bottom: 0">
                                {{ ucwords(str_replace('-', ' ', $homePage->element)) }}
                            </h5>
                            <div class="d-flex justify-content-end gap-2">
                                <form action="{{ route('homepage.edit', $homePage->id) }}" method="GET" class="d-inline">
                                    <button id="edit-btn" type="submit" class="btn btn-warning btn-sm d-flex align-items-center">
                                        <x-simpleline-pencil class="icon-size" />
                                    </button>
                                </form>
                                <form action="{{ route('homepage.destroy', $homePage->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button id="delete-btn" type="submit" class="btn btn-danger btn-sm d-flex align-items-center">
                                        <x-simpleline-trash class="icon-size" />
                                    </button>
                                </form>
                            </div>
                        </div>

                        @if ($homePage->element == 'image' || $homePage->element== 'about-image' || $homePage->element== 'vision-image' || $homePage->element== 'slider-image')
                            <img src="{{ asset($homePage->data) }}" alt="Image" class="img-fluid rounded shadow-sm mt-3" style="max-width: 100%; max-height: 50%;">
                        @else
                            @php
                                $data = $homePage->data;
                                $isHTML = false;

                                // Load the HTML into a DOMDocument
                                $dom = new DOMDocument();
                                libxml_use_internal_errors(true); // Suppress warnings for invalid HTML
                                $dom->loadHTML(
                                    '<div class="ms-2">' . $data . '</div>',
                                    LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD,
                                );
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
                                <p class="card-text text-muted p-3">{{ $data }}</p>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
