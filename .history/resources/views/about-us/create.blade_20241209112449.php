<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add About Us Element</title>
</head>
<body>
    <h1>Add About Us Element</h1>
    <form action="/about-us/store" method="POST">
        @csrf
        <label for="element">Element:</label>
        <input type="text" name="element" id="element" required>
        <br>
        <label for="data">Data:</label>
        <textarea name="data" id="data" required></textarea>
        <br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
