<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit About Us Element</title>
</head>
<body>
    <h1>Edit About Us Element</h1>
    <form action="/about-us/{{ $element->id }}" method="POST">
        @csrf
        @method('PUT')
        <label for="element">Element:</label>
        <input type="text" name="element" id="element" value="{{ $element->element }}" required>
        <br>
        <label for="data">Data:</label>
        <textarea name="data" id="data" required>{{ $element->data }}</textarea>
        <br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
