<h1>Register User</h1>

<form action="{{route('user.register')}}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="name" />
    <br><br>
    <input type="email" name="email" placeholder="email" />
    <br><br>
    <input type="password" name="password" placeholder="password" />
    <br><br>

    <!-- Status Field -->
    <label for="status">Status (Active):</label>
    <input type="checkbox" id="status" name="status" value="1">
    <br><br>
    <button>submit</button>
</form>