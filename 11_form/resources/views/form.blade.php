<!DOCTYPE html>
<html lang="en">
<head>
  <title>Form</title>
  <style>
    .input-error {
      border: 1px solid red;
    }
  </style>
</head>
<body>
  <h1>User Form</h1>

  <form action="/adduser" method="POST">
    @csrf
    <div>
      <div>
        <label for="username">Username: </label>
        <input type="text" name="username" placeholder="Jhon" value="{{ old('username') }}"
        class="{{ $errors->get('username')? 'input-error' : '' }}">
        @foreach ($errors->get('username') as $error)
          <span>{{ $error }}</span>      
        @endforeach
      </div>
      <br>

      <div>
        <label for="email">Email: </label>
        <input type="email" name="email" placeholder="Jhon@gmail.com" value="{{old('email')}}">
        @error('email')<span>{{ $message }}</span>@enderror
      </div>
      <br>

      <div>
        <label for="city">City: </label>
        <input type="text" name="city" placeholder="Mumbai" value="{{ old('city') }}">
        @error('city')<span>{{ $message }}</span>@enderror
      </div>
      <br>
    </div>
    
    <div>
      <h2>User Skills</h2>
      <input type="checkbox" name="skill" value="PHP" id="php">
      <label for="php">php</label>
      <input type="checkbox" name="skill" value="PHP" id="node">
      <label for="node">node</label>
      <input type="checkbox" name="skill" value="PHP" id="java">
      <label for="java">java</label>
      @error('skill')<span>{{ $message }}</span>@enderror
    </div>
    <br>

    <button type="submit">Add User</button>
  </form>
</body>
</html>