<h1>Register User</h1>
<form action="{{route('user.register')}}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="name">
    <br><br>
    <input type="email" name="email" placeholder="email">
    <br><br>
    <input type="password" name="password" placeholder="password">
    <br><br>
    <button>Register</button>
</form>