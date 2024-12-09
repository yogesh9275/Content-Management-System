<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Manage Elements</title>
</head>
<body>
    <h1>About Us - Elements</h1>
    <a href="/about-us/create">Add New Element</a>
    <ul>
        @foreach ($elements as $element)
            <li>
                <strong>{{ $element->element }}:</strong> {{ $element->data }}
                <a href="/about-us/{{ $element->id }}/edit">Edit</a>
                <form action="/about-us/{{ $element->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
