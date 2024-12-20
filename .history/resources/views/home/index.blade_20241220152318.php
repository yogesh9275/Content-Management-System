@section('title', 'Home Page')
@extends('layouts.home')

@section('page')
    <div class="container mt-5">
        <div class="shadow-sm p-4 rounded bg-white">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-3">
                <h3 class="mb-0 text-primary">Home - Manage Elements</h3>
                <a id="Add-btn" href="{{ route('homepage.create') }}" class="btn btn-primary"><x-bi-plus
                        class="Add-icon" />Add New Element</a>
            </div>

            {{-- Group for 'title', 'description', 'image' --}}
            @if ($homePages->whereIn('element', ['title', 'description', 'image'])->isNotEmpty())
                <div class="mt-5">

                    <div class="d-flex align-items-center mb-3">
                        <div class="border-top flex-grow-1"></div>
                        <span class="mx-3 text-muted fw-bold fs-4">Title, Description, and Image</span>
                        <div class="border-top flex-grow-1"></div>
                    </div>

                    <div class="row mb-4">
                        @foreach ($homePages->whereIn('element', ['title', 'description', 'image']) as $homePage)
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center border p-3 rounded">
                                            <h5 class="card-title text-dark fw-bold" style="margin-bottom: 0">
                                                {{ ucwords(str_replace('-', ' ', $homePage->element)) }}
                                            </h5>
                                            <div class="d-flex justify-content-end gap-2">
                                                <form action="{{ route('homepage.edit', $homePage->id) }}" method="GET"
                                                    class="d-inline">
                                                    <button id="edit-btn" type="submit"
                                                        class="btn btn-warning btn-sm d-flex align-items-center">
                                                        <x-simpleline-pencil class="icon-size" />
                                                    </button>
                                                </form>
                                                <form action="{{ route('homepage.destroy', $homePage->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button id="delete-btn" type="submit"
                                                        class="btn btn-danger btn-sm d-flex align-items-center">
                                                        <x-simpleline-trash class="icon-size" />
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        @if ($homePage->element == 'image')
                                            <img src="{{ asset($homePage->data) }}" alt="Image"
                                                class="img-fluid rounded shadow-sm mt-3"
                                                style="max-width: 50%; max-height: 50%;">
                                        @else
                                            @php
                                                $data = $homePage->data;
                                                $isHTML = false;

                                                // Load the HTML into a DOMDocument
                                                $dom = new DOMDocument();
                                                libxml_use_internal_errors(true);
                                                $dom->loadHTML(
                                                    '<div class="ms-2">' . $data . '</div>',
                                                    LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD,
                                                );
                                                libxml_clear_errors();

                                                // Check if HTML tags are present
                                                $isHTML = $dom->getElementsByTagName('*')->length > 0;

                                                // Extract the first paragraph if it is HTML
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
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Group for 'about-title', 'about-description', 'about-image' --}}
            @if ($homePages->whereIn('element', ['about-title', 'about-description', 'about-image'])->isNotEmpty())
                <div class="mt-5">
                    <div class="d-flex align-items-center mb-3">
                        <div class="border-top flex-grow-1"></div>
                        <span class="mx-3 text-muted fw-bold fs-4">About Elements</span>
                        <div class="border-top flex-grow-1"></div>
                    </div>

                    <div class="row mb-4">
                        @foreach ($homePages->whereIn('element', ['about-title', 'about-description', 'about-image']) as $homePage)
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center border p-3 rounded">
                                            <h5 class="card-title text-dark fw-bold" style="margin-bottom: 0">
                                                {{ ucwords(str_replace('-', ' ', $homePage->element)) }}
                                            </h5>
                                            <div class="d-flex justify-content-end gap-2">
                                                <form action="{{ route('homepage.edit', $homePage->id) }}" method="GET"
                                                    class="d-inline">
                                                    <button id="edit-btn" type="submit"
                                                        class="btn btn-warning btn-sm d-flex align-items-center">
                                                        <x-simpleline-pencil class="icon-size" />
                                                    </button>
                                                </form>
                                                <form action="{{ route('homepage.destroy', $homePage->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button id="delete-btn" type="submit"
                                                        class="btn btn-danger btn-sm d-flex align-items-center">
                                                        <x-simpleline-trash class="icon-size" />
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        @if ($homePage->element == 'about-image')
                                            <img src="{{ url('admin/' . $homePage->data) }}" alt="Image"
                                                class="img-fluid rounded shadow-sm mt-3"
                                                style="max-width: 50%; max-height: 50%;">
                                        @else
                                            @php
                                                $data = $homePage->data;
                                                $isHTML = false;

                                                // Load the HTML into a DOMDocument
                                                $dom = new DOMDocument();
                                                libxml_use_internal_errors(true);
                                                $dom->loadHTML(
                                                    '<div class="ms-2">' . $data . '</div>',
                                                    LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD,
                                                );
                                                libxml_clear_errors();

                                                // Check if HTML tags are present
                                                $isHTML = $dom->getElementsByTagName('*')->length > 0;

                                                // Extract the first paragraph if it is HTML
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
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Group for 'vision-title', 'vision-description', 'vision-image' --}}
            @if ($homePages->whereIn('element', ['vision-title', 'vision-description', 'vision-image'])->isNotEmpty())
                <div class="mt-5">
                    <div class="d-flex align-items-center mb-3">
                        <div class="border-top flex-grow-1"></div>
                        <span class="mx-3 text-muted fw-bold fs-4">Vision Elements</span>
                        <div class="border-top flex-grow-1"></div>
                    </div>

                    <div class="row mb-4">
                        @foreach ($homePages->whereIn('element', ['vision-title', 'vision-description', 'vision-image']) as $homePage)
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center border p-3 rounded">
                                            <h5 class="card-title text-dark fw-bold" style="margin-bottom: 0">
                                                {{ ucwords(str_replace('-', ' ', $homePage->element)) }}
                                            </h5>
                                            <div class="d-flex justify-content-end gap-2">
                                                <form action="{{ route('homepage.edit', $homePage->id) }}" method="GET"
                                                    class="d-inline">
                                                    <button id="edit-btn" type="submit"
                                                        class="btn btn-warning btn-sm d-flex align-items-center">
                                                        <x-simpleline-pencil class="icon-size" />
                                                    </button>
                                                </form>
                                                <form action="{{ route('homepage.destroy', $homePage->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button id="delete-btn" type="submit"
                                                        class="btn btn-danger btn-sm d-flex align-items-center">
                                                        <x-simpleline-trash class="icon-size" />
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        @if ($homePage->element == 'vision-image')
                                            <img src="{{ asset($homePage->data) }}" alt="Image"
                                                class="img-fluid rounded shadow-sm mt-3"
                                                style="max-width: 50%; max-height: 50%;">
                                        @else
                                            @php
                                                $data = $homePage->data;
                                                $isHTML = false;

                                                // Load the HTML into a DOMDocument
                                                $dom = new DOMDocument();
                                                libxml_use_internal_errors(true);
                                                $dom->loadHTML(
                                                    '<div class="ms-2">' . $data . '</div>',
                                                    LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD,
                                                );
                                                libxml_clear_errors();

                                                // Check if HTML tags are present
                                                $isHTML = $dom->getElementsByTagName('*')->length > 0;

                                                // Extract the first paragraph if it is HTML
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
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Slider Group (Image) in Cards --}}
            <div class="row mb-4">
                @foreach ($homePages->filter(function ($homePage) {
            return str_starts_with($homePage->element, 'slider-image-');
        }) as $homePage)
                    <!-- Filter for slider-image-* values -->
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center border p-3 rounded">
                                    <h5 class="card-title text-dark fw-bold" style="margin-bottom: 0">Slider Image</h5>
                                    <div class="d-flex justify-content-end gap-2">
                                        <form action="{{ route('homepage.edit', $homePage->id) }}" method="GET"
                                            class="d-inline">
                                            <button id="edit-btn" type="submit"
                                                class="btn btn-warning btn-sm d-flex align-items-center">
                                                <x-simpleline-pencil class="icon-size" />
                                            </button>
                                        </form>
                                        <form action="{{ route('homepage.destroy', $homePage->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button id="delete-btn" type="submit"
                                                class="btn btn-danger btn-sm d-flex align-items-center">
                                                <x-simpleline-trash class="icon-size" />
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Display slider images based on "slider-image-" element type -->
                                <img src="{{ asset($homePage->data) }}" alt="Slider Image"
                                    class="img-fluid rounded shadow-sm mt-3" style="max-width: 50%; max-height: 50%;">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


    </div>
@endsection
