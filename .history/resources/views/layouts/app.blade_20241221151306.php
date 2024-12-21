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
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
    <!-- Include Quill script -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

    <script>
        (function() {
            // Initialize Quill editor if not already done
            var quill = new Quill('#editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        [{ 'header': '1' }, { 'header': '2' }],
                        [{ 'align': [] }],
                        ['link', 'blockquote', 'code-block'],
                    ]
                }
            });

            // Get references to DOM elements for handling image upload preview
            const imageInput = document.getElementById("image");
            const newImagePreview = document.getElementById("newImagePreview");
            const currentImagePreview = document.getElementById("currentImagePreview");
            const cancelBtn = document.getElementById("cancel-btn");
            const fileSizeError = document.getElementById("file-size-error");

            // Handle image input change event
            if (imageInput) {
                imageInput.addEventListener("change", function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const fileSize = file.size / 1024 / 1024; // size in MB
                        const maxSize = 2; // 2 MB

                        // Check file size
                        if (fileSize > maxSize) {
                            fileSizeError.textContent = "File size exceeds 2MB. Please upload a smaller image.";
                            imageInput.value = ""; // clear the file input
                            newImagePreview.style.display = "none";
                            cancelBtn.style.display = "none";
                            return;
                        }

                        // Clear any previous errors
                        fileSizeError.textContent = "";

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            newImagePreview.src = e.target.result;
                            newImagePreview.style.display = "block";
                            cancelBtn.style.display = "inline-block";
                        };
                        reader.readAsDataURL(file);

                        // Hide current image preview if a new one is selected
                        if (currentImagePreview) {
                            currentImagePreview.style.display = "none";
                        }
                    }
                });
            }

            // Handle cancel button click event to reset image input and preview
            if (cancelBtn) {
                cancelBtn.addEventListener("click", function() {
                    imageInput.value = ""; // Reset file input
                    newImagePreview.style.display = "none";
                    cancelBtn.style.display = "none";

                    // Show the original current image preview if available
                    if (currentImagePreview) {
                        currentImagePreview.style.display = "block";
                    }
                });
            }

            // Ensure Quill editor content is added to the hidden input before form submission
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const longText = quill.root.innerHTML; // Get HTML content from Quill editor

                    // Check if the 'data-long-text' field exists and send to it, otherwise send to 'details' field
                    const detailsField = document.getElementById('details');
                    if (detailsField) {
                        detailsField.value = longText; // Populate 'details' input with Quill content
                    }
                });
            }
        })();
    </script>


</body>

</html>
