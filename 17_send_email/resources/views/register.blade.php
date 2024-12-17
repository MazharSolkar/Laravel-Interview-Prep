<h1>Regiser User</h1>
<br>
<form action="{{route('user.register')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" placeholder="name"/>
    <br><br>
    <input type="email" name="email" placeholder="email"/>
    <br><br>
    <input type="password" name="password" placeholder="password"/>
    <br><br>
    <label for="photo">Select Photo</label>
    <input type="file" name="photo"/>
    <br><br>
    <button>Register</button>
</form>