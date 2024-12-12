<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Gallery Management')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('laravel.svg') }}" type="image/svg+xml">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS (optional) -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/froala_editor.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Scripts -->
    <link href="{{ asset('css/Login.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Shop.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Loader.css') }}" rel="stylesheet">

    <!-- Custom Styles -->
    <link href="{{ asset('css/Shop.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <!-- Loading Spinner -->
        <div id="loading-spinner">
            <div class="loader"></div>
            <span style="color: white;">Loading...</span>
        </div>
        {{-- <div id="loading-spinner" class="loader" role="status"></div> --}}
        <main>
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
            const excludeIds = ['user-info', 'close-btn','cancel-btn', 'close-filter-btn','profileLink']; // Add more IDs as needed

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

<!-- Flora Editor JS -->
<script src="jquery.min.js"></script>
<script src="/path/to/js/froala_editor.min.js"></script>

</body>

</html>
