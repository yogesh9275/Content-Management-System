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

        <!-- Bootstrap JS Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </div>

</body>

</html>
