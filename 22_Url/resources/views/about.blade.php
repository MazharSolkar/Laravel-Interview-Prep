<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
</head>
<body>
    <h1>About Page</h1>
    <p>Current: {{ url()->current() }}</p>
    <p>Previous: {{ url()->previous() }}</p>

    <a href="{{ URL::to('/')}}">Home</a>
    <br>
    <a href="{{ URL::to('/about')}}">About</a>
    <br>
    <a href="{{ URL::to('/contact')}}">Contact</a>
    <br>
</body>
</html>