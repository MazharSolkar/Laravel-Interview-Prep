<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
</head>
<body>
  <nav>
    <ul>
      <li>Home</li>
      <li>About</li>
      <li>Contact</li>
  </ul>
  </nav>
  @yield('page-name')
  @yield('banner')
</body>
</html>