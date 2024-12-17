
# Collection
`Illuminate\Support\Collection`

- [Collection](#collection)
    - [Key Characteristics of Laravel Collections:](#key-characteristics-of-laravel-collections)
- [Creating Collection](#creating-collection)
    - [1. Create Collection From an array](#1-create-collection-from-an-array)
    - [2. Eloquent Query also returns Collection](#2-eloquent-query-also-returns-collection)
- [Common Collection Methdods](#common-collection-methdods)
    - [1. `map`](#1-map)
    - [2. `filer`](#2-filer)
    - [3. `reduce`](#3-reduce)
    - [4. `reverse`](#4-reverse)
    - [5. `all`](#5-all)
    - [6. `firstWhere`](#6-firstwhere)
    - [7. `avg`](#7-avg)
    - [8. `push`](#8-push)

**arrays are objects in Javascript, But in PHP they are primitive data types so to operate on arrays in object oriented we have collect method which converts it into collection.**

### Key Characteristics of Laravel Collections:

- `Fluent interface:` Allow you to chain multiple methods together for concise and readable code.
  
- `Immutability:` Collections are immutable, meanining every method returns an entirely new Collection instace, without modifying the original.

- `Integration with Eloquent:` Eloquent queries return collections, allowing seamless data manipulation.


# Creating Collection

### 1. Create Collection From an array
```php
$numbers = collect([1,2,3]);
```

### 2. Eloquent Query also returns Collection
```php
$users = User::all();
```

# Common Collection Methdods

### 1. `map`
```php
$numbers = collect([1,2,3]);

$squared = $numbers->map(function($number) {
  return $number * $number;
})

// Arrow Funciton
$squared = $numbers->map(fn($number) =>$number * $number);

```

### 2. `filer`
```php
$numbers = collect([1,2,3]);

$evenNumbers = $numbers->filter(function($number) {
  return $number % 2 ==== 0;
})
```

### 3. `reduce`
> $acc = accumulator represents intial value which is 0 here.
> $number = represent value in current iteration.
```php
$numbers = collect([1,2,3]);

$sum = $numbers->map(function($acc, $number) {
  return $acc + $number;
}, 0)
```
### 4. `reverse`
```php
$numbers = collect([1,2,3]);

$sum = $numbers->reverse();
```

### 5. `all`
```php
$numbers = collect([1,2,3]);

$sum = $numbers->all();
```

### 6. `firstWhere`
```php
$users = collect(
  ['name'=>'mazhar', 'age'=>23],
  ['name'=>'jane', 'age'=>34],
  ['name'=>'bob', 'age'=>40],
]);

$sum = $users->firstWhere('name', 'mazhar');
```

### 7. `avg`
```php
$numbers = collect([1,2,3]);

$average = $numbers->avg();
```

### 8. `push`
```php
$numbers = collect([1,2,3]);

$sum = $numbers->push(4);
```