@section('title', 'Add Media')
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
                    <option value="style" {{ old('media') == 'style' ? 'selected' : '' }}>Style</option>
                    <option value="script" {{ old('media') == 'script' ? 'selected' : '' }}>Script</option>
                </select>
            </div>

            <!-- Link Field -->
            <div id="links-field" class="mb-3">
                <label for="links" class="form-label">Links</label>
                <input type="url" name="links" id="links" class="form-control" value="{{ old('links') }}">
            </div>

            <!-- Text Area for Style/Script -->
            <div id="details-field" class="mb-3 d-none">
                <label for="details" class="form-label">Details</label>
                <textarea name="details" id="details" class="form-control" rows="10">{{ old('details') }}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a id="back-btn" href="{{ route('settings.index') }}" class="btn btn-secondary">Back</a>
                <button id="create-btn" type="submit" class="btn btn-primary">Add Account</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mediaSelect = document.getElementById('media');
            const linksField = document.getElementById('links-field');
            const detailsField = document.getElementById('details-field');

            const toggleFields = () => {
                const selectedMedia = mediaSelect.value;
                if (selectedMedia === 'style' || selectedMedia === 'script') {
                    linksField.classList.add('d-none');
                    linksField.querySelector('input').removeAttribute('required');
                    detailsField.classList.remove('d-none');
                    detailsField.querySelector('textarea').setAttribute('required', 'required');
                } else {
                    detailsField.classList.add('d-none');
                    detailsField.querySelector('textarea').removeAttribute('required');
                    linksField.classList.remove('d-none');
                    linksField.querySelector('input').setAttribute('required', 'required');
                }
            };

            // Initial call to set the correct fields on page load
            toggleFields();

            // Listen for changes in the media select field
            mediaSelect.addEventListener('change', toggleFields);
        });
    </script>
@endsection