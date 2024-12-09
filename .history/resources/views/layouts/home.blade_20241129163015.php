@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('sidebar')

            <!-- Main Content -->
            @if (View::hasSection('page'))
                <!-- Display the 'page' section content if defined -->
                <main class="col-md-9 col-lg-10 overflow-auto main-section">
                    <div class="dashboard px-4">
                        @yield('page')
                    </div>
                </main>
            @else
                <!-- Display default content if 'page' section is not defined -->
                    <main class="col-md-9 col-lg-10 main-section">
                        <div class="dashboard px-4">
                        @yield('dashboard')
                        </div>
                    </main>
            @endif

        </div>
    </div>
@endsection

@push('styles')
    <!-- Include Bootstrap Icons for sidebar -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
@endpush

@push('scripts')
    <!-- Include Bootstrap's Collapse functionality and toggle arrow -->
    <script>
        // Toggle the arrow direction based on the collapse state of the submenu
        document.querySelectorAll('.toggle-arrow').forEach(arrow => {
            arrow.addEventListener('click', function(event) {
                event.stopPropagation(); // Prevents the click from triggering the link redirection

                let targetId = this.getAttribute('data-bs-target');
                let targetElement = document.querySelector(targetId);
                let expanded = this.getAttribute('aria-expanded') === 'true';

                // Toggle the aria-expanded attribute
                this.setAttribute('aria-expanded', !expanded);

                // Update the icon based on whether the submenu is expanded or collapsed
                if (!expanded) {
                    this.innerHTML = '<x-simpleline-arrow-down class="arrow-size" />'; // Show down arrow
                } else {
                    this.innerHTML = '<x-simpleline-arrow-up class="arrow-size" />'; // Show up arrow
                }
            });
        });
    </script>
@endpush
