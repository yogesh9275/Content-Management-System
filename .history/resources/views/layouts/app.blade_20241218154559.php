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
    <link href="{{ asset('css/Login.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Shop.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Loader.css') }}" rel="stylesheet">

    <!-- Custom Styles -->
    <link href="{{ asset('css/Shop.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/froala_editor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/froala_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/code_view.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/colors.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/emoticons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/image_manager.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/image.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/line_breaker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/char_counter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/video.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/fullscreen.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/file.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/quick_insert.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">

    <style>
        div#editor {
            width: 100%;
            margin: auto;
            text-align: left;
        }

        .fr-box.fr-basic .fr-element {
            font-size: 1rem !important;
        }
    </style>

</head>

<body>
    <div id="app">
        <!-- Navbar with Auth -->
        @if(request()->is('/') || request()->is('home'))
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Gallery Management') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @end

        <!-- Loading Spinner -->
        <div id="loading-spinner">
            <div class="loader"></div>
            <span style="color: white;">Loading...</span>
        </div>

        <!-- Main content -->
        <main>
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery to handle the spinner visibility -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const excludeIds = ['back-btn', 'update-btn', 'create-btn', 'Add-btn', 'edit-btn', 'delete-btn'];

            $('a, button').on('click', function(event) {
                const href = $(this).attr('href');
                const target = $(this).attr('target');
                const elementId = $(this).attr('id');

                if (excludeIds.includes(elementId) && href !== '#' && target !== '_blank') {
                    // $('#loading-spinner').show(); // Show spinner logic (optional)
                }
            });

            $(window).on('beforeunload', function() {
                $('#loading-spinner').show();
            });

            $(window).on('load', function() {
                $('#loading-spinner').hide();
            });
        });
    </script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/froala_editor.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/align.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/code_beautifier.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/code_view.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/draggable.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/link.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/lists.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/paragraph_format.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/paragraph_style.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/table.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/url.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/entities.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/font_size.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/font_family.min.js') }}"></script>
    <script>
        (function () {
            const editor = new FroalaEditor('#edit', {
                enter: FroalaEditor.ENTER_P,
                placeholderText: null,
                events: {
                    initialized: function () {
                        const editor = this;
                        this.el.closest('form').addEventListener('submit', function (e) {
                            const longText = editor.html.get(); // Get the HTML content from the editor

                            // Check if the 'data-long-text' field exists, then send to 'data-long-text'
                            if (document.getElementById('data-long-text')) {
                                document.getElementById('data-long-text').value = longText;
                            } else {
                                // Otherwise send to the 'details' field
                                document.getElementById('details').value = longText;
                            }
                        });
                    }
                }
            });
        })();

        // Function to toggle divs based on selected element type
        function toggleDivs() {
            var selectedElement = document.getElementById("element").value;

            // Hide all divs first
            var allDivs = document.querySelectorAll(".element-div");
            allDivs.forEach(function(div) {
                div.style.display = "none";
            });

            // Show the div for the selected element
            if (selectedElement) {
                var selectedDiv = document.getElementById(selectedElement);
                if (selectedDiv) {
                    selectedDiv.style.display = "block";
                }
            }
        }

        // Call toggleDivs function on page load to set the initial state
        window.onload = toggleDivs;
    </script>

</body>

</html>
