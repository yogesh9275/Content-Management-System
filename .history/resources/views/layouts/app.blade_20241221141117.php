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

    <!-- Scripts -->
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

        .ss {
            background-color: red;
        }
    </style>

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
            const excludeIds = ['back-btn', 'update-btn', 'create-btn', 'Add-btn', 'edit-btn',
                'delete-btn'
            ]; // Add more IDs as needed

            // Show loading spinner before navigating (only if not opening in a new tab)
            $('a, button').on('click', function(event) {
                const href = $(this).attr('href');
                const target = $(this).attr('target'); // Get the target attribute
                const elementId = $(this).attr('id'); // Get the element ID

                // Check if the clicked element's ID is excluded, or if href is "#" or target is "_blank"
                if (excludeIds.includes(elementId) && href !== '#' && target !== '_blank') {
                    // $('#loading-spinner').show();
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

    <!-- Include Quill styles -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <!-- Include Quill script -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>




    <script>
        (function() {
            // Initialize Quill editor
            var quill = new Quill('#edit', {
                theme: 'snow', // Use the 'snow' theme, you can also use 'bubble'
                modules: {
                    toolbar: [
                        [{
                            'header': '1'
                        }, {
                            'header': '2'
                        }, {
                            'font': []
                        }],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        ['bold', 'italic', 'underline'],
                        ['link'],
                        ['blockquote'],
                        [{
                            'align': []
                        }],
                        [{
                            'color': []
                        }, {
                            'background': []
                        }],
                        ['code-block']
                    ]
                }
            });

            // On form submit, get the HTML content from Quill editor
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const longText = quill.root.innerHTML; // Get the HTML content from Quill editor

                // Check if the 'data-long-text' field exists, then send to 'data-long-text'
                if (document.getElementById('data-long-text')) {
                    document.getElementById('data-long-text').value = longText;
                } else {
                    // Otherwise send to the 'details' field
                    document.getElementById('details').value = longText;
                }
            });
        })();
    </script>


</body>

</html>
