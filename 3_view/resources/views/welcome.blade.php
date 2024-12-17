<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Passing Data from Action method to View</title>
</head>
<body>
    <h1>Fruits</h1>
    @foreach ($fruits as $fruit)
        <li>{{ $fruit }}</li>
    @endforeach

    <h1>Vegetables</h1>
    @foreach ($vegetables as $vegetable)
        <li>{{ $vegetable }}</li>
    @endforeach
</body>
</html>