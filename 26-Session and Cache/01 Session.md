# Session

- [Session](#session)
- [Using Session](#using-session)
- [1. Session with Helper Method (`session()`)](#1-session-with-helper-method-session)
- [Read Session](#read-session)
    - [1. `all()`](#1-all)
    - [2. `get()`](#2-get)
    - [3. `except()`](#3-except)
    - [4. `only()`](#4-only)
    - [5. `has()`](#5-has)
    - [6. `exists()`](#6-exists)
- [Write Session](#write-session)
    - [`put()`](#put)
- [Delete Session](#delete-session)
    - [1. `forget()`](#1-forget)
    - [2. `flush()`](#2-flush)
- [Flash Message](#flash-message)
- [Session Methods Implementation](#session-methods-implementation)

**Session is a way to store user information across multiple pages.**

- `Definition`: A session is a server-side storage mechanism that keeps data across multiple HTTP requests from the same user.
- `Purpose`: Sessions are used to store data such as user login credentials, shopping cart contents, and other user-specific information that needs to persist across different pages.

# Using Session

**There are two way to use Session.**
1. helper method
   - e.g. `session()->get('name');`
2. Session facade
   - e.g. `Session::get('name');`

# 1. Session with Helper Method (`session()`)

# Read Session

### 1. `all()`
**Get all session variables.**
```php
Route::get('/', function () {
    $value = session()->all();
});
```

### 2. `get()`
**Read Single Session Variable.**
```php
Route::get('/', function () {
    //? Way I 
    $value = session('name');
    //? Way II 
    $value = session()->get('name');
});
```

### 3. `except()`
**Reall except some variables.**
```php
Route::get('/', function () {
    $value = session()->except(['name']);   
});
```

### 4. `only()`
**Read only some of the session variables.**
```php
Route::get('/', function () {
    $value = session()->only(['name', 'class']);
});
```

### 5. `has()`
**returns true if specified key exists in the session and its value is not null. Useful when you want to check if a key exists and has a non-null value.**
```php
Route::get('/', function () {
    if(session()->has('name')) {
        $value = session()->get('name');
        echo $value;
    } else {
        echo "Name key doesn't exists.";
    }
});
```

### 6. `exists()`
**exists method: Returns true if the specified key exists in the session, regardless of its value (including null). Useful when you want to check if a key exists, even if its value is null.**
```php
Route::get('/', function () {
    if(session()->exists('name')) {
        $value = session()->get('name');
        echo $value;
    } else {
        echo "Name key doesn't exists.";
    }

    return $value;
});
```

# Write Session

### `put()`
**for flash method example (flash method set on /store-session route).**

```php
Route::get('/store-session', function () {
    // Store Single Session Variable
    session()->put('name', 'mazhar');

    // Store Multiple Session Variables
    session([
            'name'=> 'mazhar',
            'class'=> 'Btech'
    ]);
});
```

# Delete Session

### 1. `forget()`
**Used to delete session variable.**
```php
Route::get('/delete-session', function () {
    //* delete single session variable
    session()->forget(['name', 'class']);

    //* delete multiple session variables
    session()->forget(['name', 'age', 'salary']); 

    return redirect('/');
});
```

### 2. `flush()`
**Delete all session variable.**
```php
Route::get('/delete-session', function () {
    //* delete all session variables
    session()->flush();

    //* delete all session variables plus regerate token after deletion
    session()->invalidate();

    return redirect('/');
});
```

# Flash Message
- **The flash method in sessions is used to store data that will only be available for the next request. This is useful for temporary messages or notifications, such as displaying a success message after a form submission.**
- Example: We'll send message from `/store-session` route and get that message on `/` route.

```php
Route::get('/store-session', function () {
    session()->flash('status', 'Session Saved Successfully.');
    return redirect('/');
});
```

```php
Route::get('/', function () {
    session()->get('status');
});
```

# Session Methods Implementation
`web.php`
```php
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //* Get all session variables
    $value = session()->all();
    
    //* Read single session varible 
    //? Way I 
    // $value = session('name');
    //? Way II 
    // $value = session()->get('name');

    //* Read all except some variables
    // $value = session()->except(['name']);

    //* Read only some of the session variables
    // $value = session()->only(['name', 'class']);

    //* Check if particular session variable exists

    //? has method: returns true if specified key exists in the session and its value is not null. Useful when you want to check if a key exists and has a non-null value.
    // if(session()->has('name')) {
    //     $value = session()->get('name');
    //     echo $value;
    // } else {
    //     echo "Name key doesn't exists.";
    // }

    //? exists method: Returns true if the specified key exists in the session, regardless of its value (including null). Useful when you want to check if a key exists, even if its value is null.
    // if(session()->exists('name')) {
    //     $value = session()->get('name');
    //     echo $value;
    // } else {
    //     echo "Name key doesn't exists.";
    // }

    // return $value;

    //* for flash method example (flash method set on /store-session route)
    $value = session()->get('name');

    return view('welcome', compact('value'));
});

Route::get('/store-session', function (Request $request) {
    //* Store single session variable
    //? Way I
    // session()->put('name', 'mazhar');
    //? way II
    // $request->session()->put('class', 'Btech'); //put method is compulsory with $request object

    //* Store multiple session variable
    // session([
    //         'name'=> 'mazhar',
    //         'class'=> 'Btech'
    // ]);

    
    //* regerate token each time user visit this url(/session-store) for security purpose. (You can apply it on all the urls through middleware)
    // session()->regenerate();
    
    //* flash method
    // flash method is used when we want to send message from one page to another page.
    session(['name'=> 'mazhar']);
    
    session()->flash('status', 'Session Saved Successfully.');

    return redirect('/');
});

Route::get('/delete-session', function () {
    //* delete single session variable
    // session()->forget(['name', 'class']);

    //* delete multiple session variables
    // session()->forget(['name', 'age', 'salary']) 

    //* delete all session variables
    // session()->flush();

    //* delete all session variables plus regerate token after deletion
    session()->invalidate();

    return redirect('/');
});
```