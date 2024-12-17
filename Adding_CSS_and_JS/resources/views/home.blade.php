<!DOCTYPE html>
<html lang="en">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>
<body>
    <h1>Home Page</h1>
    <div>
        <img src="images/mazhar.jpeg">
        <img src="{{ asset('images/mazhar.jpeg')}}">
    </div>
</body>
</html>

