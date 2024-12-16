@section('title', 'Home Page')
@extends('layouts.home')

@section('page')
    <div class="container mt-5">
        <div class="shadow-sm p-4 rounded bg-white">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-3">
                <h3 class="mb-0 text-primary">Home - Manage Elements</h3>
                <a id="Add-btn" href="{{ route('homepage.create') }}" class="btn btn-primary">
                    <x-bi-plus class="Add-icon" /> Add New Element
                </a>
            </div>

            <div class="row g-4">
                <!-- Cards for Title, Description, Image -->
                @foreach ($homePages as $homePage)
                    @if (in_array($homePage->element, ['title', 'description', 'image']))
                        <div class="col-md-4">
                            <div class="card my-2">
                                <div class="card-body">
                                    <h5 class="card-title text-dark fw-bold mb-3">
                                        {{ ucwords(str_replace('-', ' ', $homePage->element)) }}
                                    </h5>

                                    @if ($homePage->element == 'image')
                                        <img src="{{ asset($homePage->data) }}" alt="Image" class="img-fluid rounded shadow-sm" style="max-width: 100%; max-height: 100%;">
                                    @elseif ($homePage->element == 'Title' || $homePage->element == 'Description')
                                        <p class="card-text text-muted">{{ $homePage->data }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                <!-- Cards for About Title, About Description, About Image -->
                @foreach ($homePages as $homePage)
                    @if (in_array($homePage->element, ['about-title', 'about-description', 'about-image']))
                        <div class="col-md-4">
                            <div class="card my-2">
                                <div class="card-body">
                                    <h5 class="card-title text-dark fw-bold mb-3">
                                        {{ ucwords(str_replace('-', ' ', $homePage->element)) }}
                                    </h5>

                                    @if ($homePage->element == 'about-image')
                                        <img src="{{ asset($homePage->data) }}" alt="Image" class="img-fluid rounded shadow-sm" style="max-width: 100%; max-height: 100%;">
                                    @else
                                        <p class="card-text text-muted">{{ $homePage->data }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                <!-- Cards for Vision Title, Vision Description, Vision Image -->
                @foreach ($homePages as $homePage)
                    @if (in_array($homePage->element, ['vision-title', 'vision-description', 'vision-image']))
                        <div class="col-md-4">
                            <div class="card my-2">
                                <div class="card-body">
                                    <h5 class="card-title text-dark fw-bold mb-3">
                                        {{ ucwords(str_replace('-', ' ', $homePage->element)) }}
                                    </h5>

                                    @if ($homePage->element == 'vision-image')
                                        <img src="{{ asset($homePage->data) }}" alt="Image" class="img-fluid rounded shadow-sm" style="max-width: 100%; max-height: 100%;">
                                    @else
                                        <p class="card-text text-muted">{{ $homePage->data }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                <!-- Image Slider -->
                @foreach ($homePages as $homePage)
                    @if ($homePage->element == 'slider-image')
                        <div class="col-md-4">
                            <div class="card my-2">
                                <div class="card-body">
                                    <h5 class="card-title text-dark fw-bold mb-3">
                                        {{ ucwords(str_replace('-', ' ', $homePage->element)) }}
                                    </h5>

                                    <div id="carouselExample" class="carousel slide">
                                        <div class="carousel-inner">
                                            @foreach (json_decode($homePage->data) as $key => $sliderImage)
                                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                    <img src="{{ asset($sliderImage) }}" class="d-block w-100" alt="Slider Image">
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
