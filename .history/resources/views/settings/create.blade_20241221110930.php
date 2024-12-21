@section('title', 'Add News')
@extends('layouts.home')

@section('page')
    <div class="container mt-4">
        <h1 class="mb-4">Add a Social Media Account</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Media Text Field (Instead of Title) -->
            <div class="mb-3">
                <label for="media" class="form-label">Media</label>
                <select name="media" id="media" class="form-control" required>
                    <option value="">Select Media</option> <!-- Default "Select" option -->
                    <option value="facebook" {{ old('media') == 'facebook' ? 'selected' : '' }}>Facebook</option>
                    <option value="instagram" {{ old('media') == 'instagram' ? 'selected' : '' }}>Instagram</option>
                    <option value="twitter" {{ old('media') == 'twitter' ? 'selected' : '' }}>Twitter</option>
                    <option value="style" {{ old('media') == 'style' ? 'selected' : '' }}>St</option>
                </select>
            </div>



            <!-- Link Field -->
            <div class="mb-3">
                <label for="links" class="form-label">Links</label>
                <input type="url" name="links" id="links" class="form-control" value="{{ old('links') }}" required>
            </div>

            <input type="hidden" name="details" id="details">

            <div class="d-flex justify-content-between">
                <a id="back-btn" href="{{ route('settings.index') }}" class="btn btn-secondary">Back</a>
                <button id="create-btn" type="submit" class="btn btn-primary">Add Account</button>
            </div>
        </form>
    </div>
@endsection
