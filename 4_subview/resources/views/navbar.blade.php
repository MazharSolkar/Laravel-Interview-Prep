<ul>
  <h1>Navbar</h1>
  <li><a href="/">Home</a></li>
  <li><a href="/about">About</a></li>
  <li><a href="/contact">Contact</a></li>

  <h1>Vegetables</h1>
  @foreach ($vegetables as $vegetable)
      <li>{{ $vegetable }}</li>
  @endforeach
</ul>

