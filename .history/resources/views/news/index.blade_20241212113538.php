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
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Details</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->title }}</td>
                    <td>
                        @if ($item->image_path)
                            <img src="{{ asset('storage/' . $item->image_path) }}" alt="News Image" style="width: 100px;">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>{{ \Illuminate\Support\Str::limit($item->details, 50) }}</td>
                    <td>
                        <a href="{{ route('news.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('news.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No news items found.</p>
    @endif
</div>
@endsection
