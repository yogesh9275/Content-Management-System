<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit About Us Element</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Edit About Us Element</h3>
            </div>
            <div class="card-body">
                <form action="/about-us/{{ $element->id }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="element" class="form-label">Element</label>
                        <input type="text" class="form-control" name="element" id="element"
                               value="{{ $element->element }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="data" class="form-label">Data</label>
                        <textarea class="form-control" name="data" id="data" rows="5" required>{{ $element->data }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="/about-us" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
