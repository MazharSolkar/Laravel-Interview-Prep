## Accessing Form input using Request Class

`web.php`
```php
Route::get('/', function () {
    return view('home');
});

Route::view('/user-form','form');

Route::Post('/addUser', function(Request $request) {
    echo "$request->name";
    echo "<br>";
    echo "$request->lname";
    dd($request);
});
```

`form.blade.php`
```php
  <h1>User Form</h1>
  <form action="/addUser" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Jhon">
    <br><br>
    <input type="text" name="lname" placeholder="Doe">
    <br><br>
    <button type="submit">Add User</button>
  </form>
```

## Hanlding Different types of Input

`form.blade.php`
```php
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Form</title>
</head>
<body>
  <h1>User Form</h1>
  <form action="/adduser" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Doe">
    <br><br>
    
    <div>
      <h2>User Skills</h2>
      <input type="checkbox" name="skill" value="PHP" id="php">
      <label for="php">php</label>
      <input type="checkbox" name="skill" value="PHP" id="node">
      <label for="node">node</label>
      <input type="checkbox" name="skill" value="PHP" id="java">
      <label for="java">java</label>
    </div>
    <br>

    <div>
      <h2>Gender</h2>
      <input type="radio" name="gender" value="male" id="male">
      <label for="male">Male</label>
      <input type="radio" name="gender" value="female" id="female">
      <label for="female">Female</label>
    </div>
    <br>

    <div>
      <h3>City</h3>
      <select name="city" id="">
        <option value="Delhi">Delhi</option>
        <option value="Pune">Pune</option>
        <option value="Mumbai">Mumbai</option>
      </select>
    </div>
    <br>

    <input type="range" name="age" min="18" max="100">
    <br><br>

    <button type="submit">Add User</button>
  </form>
</body>
</html>
```

`UserController.php`
```php
class UserController extends Controller
{

    public function addUser (Request $request) {
        echo $request->name;
        echo "<br>";
        echo $request->skill;
        echo "<br>";
        echo $request->gender;
        echo "<br>";
        echo $request->city;
        echo "<br>";
        echo $request->age;
        echo "<br>";
        dd($request);
    }
}
```

## Form Validation Rule

`form.blade.php`
```php
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Form</title>
</head>
<body>
  <h1>User Form</h1>

  {{ print_r($errors->all()) }}
  {{-- @if($errors->any())
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
  @endif --}}

  <form action="/adduser" method="POST">
    @csrf
    <div>
      <div>
        <label for="username">Username: </label>
        <input type="text" name="username" placeholder="Jhon">
        <span>@error('username'){{ $message }}@enderror</span>
      </div>
      <br>
      <div>
        <label for="email">Email: </label>
        <input type="email" name="email" placeholder="Jhon@gmail.com">
        <span>@error('username'){{ $message }}@enderror</span>
      </div>
      <br>

      <div>
        <label for="city">City: </label>
        <input type="text" name="city" placeholder="Mumbai">
        <span>@error('city'){{ $message }}@enderror</span>
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
      <span>@error('skill'){{ $message }}@enderror</span>
    </div>
    <br>

    <button type="submit">Add User</button>
  </form>
</body>
</html>
```

`UserController.php`
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function addUser (Request $request) {
        $request->validate(
            [
                "username"=> "required | min:3 | max:10",
                "email"=> "required | email",
                "city"=> "required",
                "skill"=> "required | max:10"
            ]
            );
    }
}
```

## Changing Default error message of validation rules

`UserController.php`
```php
class UserController extends Controller
{

    public function addUser (Request $request) {
        $request->validate(
            [
                "username"=> "required | min:3 | max:10",
                "email"=> "required | email",
                "city"=> "required",
                "skill"=> "required | max:10"
            ], [
                "username.required" => "username can't be empty",
                "username.min" => "username mininum 3 characters",
                "username.max" => "username maximum 10 characters",
                "email.required" => "email can't be empty",
            ],
            );
    }
}
```

## When we submit form fields get empty how to keep value in form field after submission

```php
value="{{ old('username') }}"
```

## When input field have error i want to add different style to it

`from.blade.php`
```php
  <style>
    .input-error {
      border: 1px solid red;
      color: red;
    }
  </style>

      <div>
        <label for="username">Username: </label>
        <input type="text" name="username" placeholder="Jhon" value="{{ old('username') }}"
        class="{{ $errors->first('username')? 'input-error' : '' }}">
        <span>@error('username'){{ $message }}@enderror</span>
      </div>
```

## Custom Validation Rule

### Create rule
```bash
  php artisan make:rule Uppercase
  # App\Rules\Uppercase.php
```

### Write code for validation
`Uppercase.php`
```php
class Uppercase implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        if(strtoupper($value) != $value) {
            $fail('the :attribute must be in uppercase');
        }
    }
}
```

### Apply the rule on `city` input
`UserController.php`
```php
  $request->validate(
            [
              "city"=> "required | uppercase"
            ]
  )
```