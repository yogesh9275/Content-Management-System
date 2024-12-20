@section('title', 'News')
@extends('layouts.home')

@section('page')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-3">
        <h3 class="mb-0 text-primary">News List</h3>
        <a id="Add-btn" href="{{ route('news.create') }}" class="btn btn-primary">
            <x-bi-plus class="Add-icon" />Add News
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($news->count())
        <div class="row my-4">
            @foreach ($news as $item)
                <div class="col-md-4 mb-4">
                    <div class="card d-flex flex-column h-100">
                        @if ($item->image_path)
                            <img src="{{ url( $item->image_path) }}" class="card-img-top" alt="News Image" style="max-height: 200px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-secondary text-white d-flex justify-content-center align-items-center" style="height: 200px;">
                                No Image
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="text-muted mb-2">{{ $item->created_at->format('F d, Y') }}</p>
                            <div class="actions d-flex justify-content-end gap-2 mt-auto">
                                <form action="{{ route('news.edit', $item->id) }}" method="GET" class="d-inline">
                                    <button id="edit-btn" type="submit" class="btn btn-warning btn-sm d-flex align-items-center">
                                        <x-simpleline-pencil class="icon-size" />
                                    </button>
                                </form>
                                <form action="{{ route('news.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button id="delete-btn" type="submit" class="btn btn-danger btn-sm d-flex align-items-center" onclick="return confirm('Are you sure?')">
                                        <x-simpleline-trash class="icon-size" />
                                    </button>
                                </form>
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
