<!DOCTYPE html>
<html lang="en">
<head>
    <title>Passing Data from Action method to View</title>
</head>
<body>
    @include('navbar')
    <h1>Fruits</h1>
    @foreach ($fruits as $fruit)
        <li>{{ $fruit }}</li>
    @endforeach
</body>
</html>

