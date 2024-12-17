<form action="{{route('user.register')}}" method="POST">
    @csrf
    <div>
        <h1>Registration Form</h1>
    </div>
    <input type="text" name="name" placeholder="name" />
    @error('name') <span style="color:red">{{$message}}</span> @enderror
    <br><br>
    <input type="email" name="email" placeholder="email" />
    @error('email') <span style="color:red">{{$message}}</span> @enderror
    <br><br>
    <input type="password" name="password" placeholder="password" />
    @error('password') <span style="color:red">{{$message}}</span> @enderror
    <br><br>
    <label for="subscribe">Subscribe to our newsletter</label>
    <input type="checkbox" name="subscribe" value="1" />
    <br><br>
    <button>Register</button>
    <br><br>
</form>