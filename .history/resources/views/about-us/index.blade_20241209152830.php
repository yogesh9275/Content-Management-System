<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Manage Elements</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h3 class="mb-0">About Us - Manage Elements</h3>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <h5 class="mb-0">Elements List</h5>
                    <a href="/about-us/create" class="btn btn-primary">Add New Element</a>
                </div>
                <ul class="list-group">
                    @foreach ($elements as $element)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $element->element }}:</strong>
                                <!-- Check if the element type is 'Image' -->
                                @if($element->element == 'Image')
                                    <!-- Display image using the URL stored in $data -->
                                    <img src="{{ asset($element->data) }}" alt="Image" class="img-fluid" style="height: 200;">
                                @else
                                    @php
                                        $data = $element->data;
                                        $firstParagraph = strtok($data, "\n"); // Extracts the first paragraph based on new lines
                                    @endphp
                                    <p>{{ $firstParagraph }}</p>
                                @endif
                            </div>
                            <div class="d-flex flex-column">
                                <a href="/about-us/{{ $element->id }}/edit" class="btn btn-warning btn-sm mb-2">Edit</a>
                                <form action="/about-us/{{ $element->id }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
