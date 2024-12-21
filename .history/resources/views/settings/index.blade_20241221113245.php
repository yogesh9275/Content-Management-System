@section('title', 'Settings')
@extends('layouts.home')

@section('page')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center border-bottom pb-3">
            <h3 class="mb-0 text-primary">Social Media List</h3>
            <a id="Add-btn" href="{{ route('settings.create') }}" class="btn btn-primary">
                <x-bi-plus class="Add-icon" />Add Acccount
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($settings->count())
            <div class="row my-4">
                @foreach ($settings as $item)
                    <div class="col-md-12 mb-4">
                        <div class="card d-flex flex-row align-items-start">
                            <!-- Media Column (Left side) displaying media text -->
                            <div class="card-img-left bg-white text-white d-flex justify-content-center align-items-center"
                                style="width: fit-content; height: fit-content;">
                                @if ($item->media)
                                    <!-- Check the media type and display the appropriate image icon -->
                                    @if ($item->media == 'facebook')
                                        <img src="{{ asset('social/facebook.png') }}" alt="Facebook" class="media-icon"
                                            style="width: 165px; height: 165px; object-fit: contain;">
                                    @elseif ($item->media == 'instagram')
                                        <img src="{{ asset('social/instagram.png') }}" alt="Instagram" class="media-icon"
                                            style="width: 165px; height: 165px; object-fit: contain;">
                                    @elseif ($item->media == 'twitter')
                                        <img src="{{ asset('social/twitter.png') }}" alt="Twitter" class="media-icon"
                                            style="width: 165px; height: 164px; object-fit: contain;">
                                    @elseif ($item->media == 'script')
                                        <img src="{{ asset('social/js.png') }}" alt="Script" class="media-icon"
                                            style="width: 5rem; height: 5rem; object-fit: contain;">
                                    @elseif ($item->media == 'style')
                                        <img src="{{ asset('social/css.png') }}" alt="Style" class="media-icon"
                                            style="max-width: 90%; max-height: 90%; object-fit: contain;">
                                    @else
                                        <span class="media-text">{{ $item->media }}</span>
                                        <!-- Display media text if no matching icon -->
                                    @endif
                                @else
                                    <span>No Media</span>
                                @endif
                            </div>


                            <!-- Text and Links Column (Right side) -->
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $item->title }}</h5>
                                <p class="text-muted mb-2">{{ $item->created_at->format('F d, Y') }}</p>

                                <!-- Links section (below the title) -->
                                @if ($item->data)
                                    <div class="mb-2 p-2 border" style="background-color: #f5f5f5;">
                                        <strong>Links:</strong> <span>{{ $item->data }}</span>
                                    </div>
                                @endif

                                <!-- Action Buttons (Edit, Delete) -->
                                <div class="actions d-flex justify-content-end gap-2 mt-auto">
                                    <form action="{{ route('settings.edit', $item->id) }}" method="GET" class="d-inline">
                                        <button id="edit-btn" type="submit"
                                            class="btn btn-warning btn-sm d-flex align-items-center">
                                            <x-simpleline-pencil class="icon-size" />
                                        </button>
                                    </form>
                                    {{-- <form action="{{ route('news.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button id="delete-btn" type="submit" class="btn btn-danger btn-sm d-flex align-items-center" onclick="return confirm('Are you sure?')">
                                        <x-simpleline-trash class="icon-size" />
                                    </button>
                                </form> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No news items found.</p>
        @endif
    </div>
@endsection
