<div>
    <form action="{{route('user.login')}}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="test@gmail.com">
        <br><br>
        <input type="password" name="password" placeholder="********">
        <br><br>
        <button type="submit">login</button>
    </form>
</div>