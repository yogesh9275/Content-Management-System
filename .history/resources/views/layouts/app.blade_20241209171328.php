<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gallery Management')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS (optional) -->
    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
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

    <main class="container">
        @yield('content')
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">© {{ date('Y') }} Gallery App. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
