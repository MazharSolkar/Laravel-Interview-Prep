<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div>
        @if (session('success'))
            <h1 style="color: green;">{{session('success')}}</h1>
        @elseif (session('error'))
            <h1 style="color: red;">{{session('error')}}</h1>
        @endif
    </div>

    <div>
        <form action="{{route('user.logout')}}" method="POST">
            @csrf
            <button
            style="color:white; border:none; background:red; border-radius: 5px; padding:5px 5px; font-size:1rem;"
            >
            logout
            </button>
        </form>
    </div>

    <h1>@yield('title')</h1>

    <div style="margin-top: 10px;">
        @yield('main')
    </div>
</body>
</html>
