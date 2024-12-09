<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Gallery Management')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('laravel.svg') }}" type="image/svg+xml">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS (optional) -->
    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>

    <!-- Custom Styles -->
    <link href="{{ asset('css/Shop.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        @php
            // Determine if the current route matches the ones where the navbar should be displayed
            $showNavbar =
                in_array(request()->route()->getName(), ['main', 'login', 'register']) ||
                (auth()->check() && request()->route()->getName() === 'main');
        @endphp

        {{-- @if ($showNavbar) --}}
            <!-- Sidebar -->
            <div class="sidebar bg-dark text-white" style="width: 250px; height: 100vh; position: fixed; top:0">
                <div class="sidebar-header p-4">
                    <h4>Content Management</h4>
                </div>
                <ul class="nav flex-column p-3">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('galleries.index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('galleries.create') }}">Add Image</a>
                    </li>
                </ul>
            </div>
        {{-- @endif --}}

        <!-- Main content area -->
        <main class="container" style="margin-left: 250px; padding: 20px;">
            @yield('content')
        </main>
    </div>
    <!-- Allowing the custom scripts -->
    @stack('scripts') <!-- This will load any script pushed to the stack -->

     <!-- Bootstrap JS Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
     
    <!-- jQuery to handle the spinner visibility -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // List of IDs to exclude from showing the loader
            const excludeIds = ['user-info', 'close-btn', 'close-filter-btn']; // Add more IDs as needed

            // Show loading spinner before navigating (only if not opening in a new tab)
            $('a, button').on('click', function(event) {
                const href = $(this).attr('href');
                const target = $(this).attr('target'); // Get the target attribute
                const elementId = $(this).attr('id'); // Get the element ID

                // Check if the clicked element's ID is excluded, or if href is "#" or target is "_blank"
                if (!excludeIds.includes(elementId) && href !== '#' && target !== '_blank') {
                    $('#loading-spinner').show();
                }
            });

            // Show the loading spinner when the page is being refreshed or reloaded
            $(window).on('beforeunload', function() {
                $('#loading-spinner').show();
            });

            // Hide the spinner when the page has fully loaded
            $(window).on('load', function() {
                $('#loading-spinner').hide();
            });
        });
    </script>

</body>

</html>
