@extends('layouts.home')

@section('page')
<div class="container mt-4">
    <h1 class="mb-4">News List</h1>
    <a href="{{ route('news.create') }}" class="btn btn-primary mb-3">Add News</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($news->count())
        <div class="row">
            @foreach ($news as $item)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if ($item->image_path)
                            <img src="{{ asset($item->image_path) }}" class="card-img-top" alt="News Image" style="max-height: 200px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-secondary text-white d-flex justify-content-center align-items-center" style="height: 200px;">
                                No Image
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="text-muted mb-2">{{ $item->created_at->format('F d, Y') }}</p>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('news.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('news.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
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
