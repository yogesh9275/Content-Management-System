@section('title', 'Edit News')
@extends('layouts.home')

@section('page')
    <div class="container mt-4">
        <h1 class="mb-4">Edit News</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Media Dropdown Field -->
            <div class="mb-3">
                <label for="media" class="form-label">Select Media</label>
                <select name="media" id="media" class="form-control" required>
                    <option value="">Select Media</option>
                    <option value="facebook" {{ old('media', $setting->media) == 'facebook' ? 'selected' : '' }}>Facebook</option>
                    <option value="instagram" {{ old('media', $setting->media) == 'instagram' ? 'selected' : '' }}>Instagram</option>
                    <option value="twitter" {{ old('media', $setting->media) == 'twitter' ? 'selected' : '' }}>Twitter</option>
                    <option value="threads" {{ old('media', $news->media) == 'threads' ? 'selected' : '' }}>Threads</option>
                </select>
            </div>

            <!-- Link Field -->
            <div class="mb-3">
                <label for="links" class="form-label">Links</label>
                <input type="url" name="links" id="links" class="form-control" value="{{ old('links', $setting->links) }}" required>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between">
                <a id="back-btn" href="{{ route('settings.index') }}" class="btn btn-secondary">Back</a>
                <button id="update-btn" type="submit" class="btn btn-success">Update News</button>
            </div>
        </form>
    </div>
@endsection
