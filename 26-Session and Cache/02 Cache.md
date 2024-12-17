# Cache

- [Cache](#cache)
- [Use Cache](#use-cache)
  - [Cache with Facades](#cache-with-facades)
      - [Storing Item](#storing-item)
      - [1. `put()`](#1-put)
    - [Read Item](#read-item)
      - [1. `get()`](#1-get)
      - [2. `get()` with default value](#2-get-with-default-value)
      - [3. `has()`](#3-has)
    - [Delete Item](#delete-item)
      - [1. `forget()`](#1-forget)
      - [2. `flush()`](#2-flush)
- [Example](#example)

**Cache is used to improve performance. Caching involves storing the results of expensive operations or frequently accessed data so that future requests can retrieve the data more quickly.**

# Use Cache
**There are two ways to use Cache.**
1. Helper method
2. Facades

## Cache with Facades

#### Storing Item

#### 1. `put()`
> Storing Item Permanantly
```php
Cache::put('email', 'm@gmail.com')
dd(Cache::get('email'));
```

> Storing Item for 10 seconds.
```php
Cache::put('state', 'Maharashtra', now()->addMinutes(5));
dd(Cache::get('name'));
```

> Give Time using datetime method
```php
Cache::put('state', 'Maharashtra', now()->addMinutes(5));
dd(Cache::get('name'));
```

> Using Closure
> **Using Closure (if city is already there then we'll get that value else we'll get value returned from closure).**
```php
Cache::remember('city',1, function () {
  return 'Mumbai';
});
dd(Cache::get('city'));
```

### Read Item

#### 1. `get()`
```php
dd(Cache::get('name'));
```

#### 2. `get()` with default value
```php
dd(Cache::get('username', 'default'))
```

#### 3. `has()`
**returns true when item is present and not null.**
```php
if(Cache::has('name')) {
        dd("item exists in cache");
    }
```

### Delete Item

#### 1. `forget()`
```php
Cache::forget('name');
```

#### 2. `flush()`
**Clear Cache.**
```php
Cache::flush();
```

# Example

`web.php`
```php
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

Route::get('/', function () {
    //TODO: Storing Item (using Cache Facades)

    //* storing Item for 10sec
    // Cache::put('email','m@gmail.com', $seconds=10);
    // dd(Cache::get('email'));

    // *give time using datetime method (keep the item for 5minutes)
    // Cache::put('state', 'Maharashtra', now()->addMinutes(5));
    // dd(Cache::get('name'));

    // *store item permanently
    // ?put method without time
    // Cache::put('name','mazhar');
    // dd(Cache::get('name'));

    // ?forever method
    // Cache::forever('lname', 'solkar');
    // dd(Cache::get('lname'));
    
    // *Using Closure (if city is already there then we'll get that value else we'll get value returned from closure)
    // Cache::remember('city',1, function () {
    //     return 'Mumbai';
    // });
    // dd(Cache::get('city'));

    // *store item using add method
    // key, value, time(in minutes) => below code will return true if added successfully
    // dd(Cache::add('roll',02, 1));

    //TODO: Get Item (using Cache Facades)

    // *get method
    // dd(Cache::get('name'));

    // *get with default value
    // dd(Cache::get('username', 'default'));

    // *passing multiple cache item to view
    // $name = Cache::get('name');
    // $lname = Cache::get('lname');
    // return view('welcome', compact('name','lname'));

    // TODO: Item Exists in Cache (using Cache Facades)

    // if(Cache::has('name')) {
    //     dd("item exists in cache");
    // }

    // TODO: Removing Item (using Cache Facades)
    
    // *forget method
    // Cache::forget('name');

    // *put method set minute to 0 or minus value (e.g. -5)
    // Cache::put('name','mazhar',0);

    // *Clear Cache
    // Cache::flush();

});
```