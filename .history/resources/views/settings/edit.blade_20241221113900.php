@section('title', 'Edit Media')
@extends('layouts.home')

@section('page')
    <div class="container mt-4">
        <h1 class="mb-4">Edit Media</h1>

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
                    <option value="style" {{ old('media', $setting->media) == 'style' ? 'selected' : '' }}>Style</option>
                    <option value="script" {{ old('media', $setting->media) == 'script' ? 'selected' : '' }}>Script</option>
                </select>
            </div>

            <!-- Link Field -->
            <div id="links-field" class="mb-3" style="display: {{ in_array(old('media', $setting->media), ['facebook', 'instagram', 'twitter']) ? 'block' : 'none' }};">
                <label for="links" class="form-label">Links</label>
                <input type="url" name="links" id="links" class="form-control" value="{{ old('links', $setting->data) }}">
            </div>

            <!-- Details Field -->
            <div id="details-field" class="mb-3" style="display: {{ in_array(old('media', $setting->media), ['style', 'script']) ? 'block' : 'none' }};">
                <label for="details" class="form-label">Details</label>
                <textarea name="details" id="details" class="form-control" rows="5">{{ old('details', $setting->data) }}</textarea>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between">
                <a id="back-btn" href="{{ route('settings.index') }}" class="btn btn-secondary">Back</a>
                <button id="update-btn" type="submit" class="btn btn-success">Update Media</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mediaField = document.getElementById('media');
            const linksField = document.getElementById('links-field');
            const detailsField = document.getElementById('details-field');

            mediaField.addEventListener('change', function () {
                const selectedMedia = mediaField.value;

                // Show/Hide fields based on the selected media type
                if (['facebook', 'instagram', 'twitter'].includes(selectedMedia)) {
                    linksField.style.display = 'block';
                    detailsField.style.display = 'none';
                } else if (['style', 'script'].includes(selectedMedia)) {
                    linksField.style.display = 'none';
                    detailsField.style.display = 'block';
                } else {
                    linksField.style.display = 'none';
                    detailsField.style.display = 'none';
                }
            });
        });
    </script>
@endsection
