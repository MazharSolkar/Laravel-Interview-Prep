<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Laravel Component</title>
</head>
<body>
    <h1 class="bg-red-400">Home Page</h1>
    <h1 class="text-center text-3xl my-4">Products</h1>
    @foreach ($posts as $post)
        <x-card :post="$post" />
    @endforeach

    <form class="flex flex-col items-center">
        <h1 class="text-center text-3xl my-4">Form</h1>
        <x-form.input placeholder="Jhon"/>
        <x-form.input type="email" placeholder="test@xyz.com" />
        <x-form.input type="password" placeholder="********" />
        <x-button :flag="$flag" class="p-2" />
    </form>

</body>
</html>