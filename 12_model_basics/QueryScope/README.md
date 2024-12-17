# Query Builder

# Basic Select Queries

### 1. `get()`
Retrieves all rows from the table.
```php
$users = DB::table('users')->get();
```

### 2. `first()`
Retrieves the first row.
```php
$user = DB::table('users')->where('name', 'John')->first();
```

### 3. `select()`
Specifies the columns to be selected.
```php
$users = DB::table('users')->select('name', 'email')->get();
```

# Where Clauses

### 1. `where()`
Adds a simple where clause.
```php
$users = DB::table('users')->where('status', 'active')->get();
```

### 2. `orWhere()`
Adds an `or where` clause.
```php
$users = DB::table('users')->where('status', 'active')->orWhere('role', 'admin')->get();
```

### 3. `whereBetween()`
Filters results within a range.
```php
$users = DB::table('users')->whereBetween('age', [25, 35])->get();
```

### 4. `whereIn()`
Filters results that match any value in a given array.
```php
$users = DB::table('users')->whereIn('id', [1, 2, 3])->get();
```

# Aggregates

### 1. `count()`
Count the number of results.
```php
$userCount = DB::table('users')->count();
```

### 2. `max()`
Find the maximum value of a column.
```php
$maxAge = DB::table('users')->max('age');
```

### 3. `avg()`
Calculates the average value of a column.
```php
$averageAge = DB::table('users')->avg('age');
```

### 4. `sum()`
```php
$totalAge = DB::table('users')->sum('age');
```

# Joins

### 1. `join()`
Performs an inner join.
```php
$users = DB::table('users')
    ->join('contacts', 'users.id', '=', 'contacts.user_id')
    ->select('users.*', 'contacts.phone')
    ->get();
```

### 2. `leftJoin()`
Performs a left join.
```php
$users = DB::table('users')
    ->leftJoin('contacts', 'users.id', '=', 'contacts.user_id')
    ->get();
```

# Ordering and Grouping

### 1. `orderBy()`
Orders the results by a column.
```php
$users = DB::table('users')->orderBy('name', 'desc')->get();
```

### 2. `groupBy()`
Groups the results by a column.
```php
$users = DB::table('users')
    ->select(DB::raw('count(*) as user_count, status'))
    ->groupBy('status')
    ->get();
```

### 3. `having()`
Filter the results of a `groupBy`.
```php
$users = DB::table('users')
    ->select(DB::raw('count(*) as user_count, status'))
    ->groupBy('status')
    ->having('user_count', '>', 1)
    ->get();
```

# Pagination

### 1. `paginate()`
Paginate the results.
```php
$users = DB::table('users')->paginate(10);
```

### 2. `simplePaginate()`
Provides a simple pagination (without total count).
```php
$users = DB::table('users')->simplePaginate(10);
```

# Insert, Update, Delete, Truncate

### 1. `insert()`
Inserts new records.
```php
DB::table('users')->insert([
    ['name' => 'John', 'email' => 'john@example.com'],
    ['name' => 'Jane', 'email' => 'jane@example.com']
]);
```

### 2. `update()`
Updates existing records.
```php
DB::table('users')->where('id', 1)->update(['name' => 'John Doe']);
```

### 3. `delete()`
Deletes records.
```php
DB::table('users')->where('id', 1)->delete();
```

### 4. `truncate()`
Deletes all the records from table.
```php
DB::table('users')->truncate()
```

# Raw Expressions

### 1. `DB::raw()`
For complex expressions.
```php
$users = DB::table('users')
    ->select(DB::raw('count(*) as user_count, status'))
    ->groupBy('status')
    ->get();
```

### `whereRaw()`
Adds a raw `where` clause.
```php
$users = DB::table('users')
    ->whereRaw('age > ? and votes = 100', [25])
    ->get();
```

### `havingRaw()`
Adds a raw `having` clause.
```php
$users = DB::table('users')
    ->select(DB::raw('count(*) as user_count, status'))
    ->groupBy('status')
    ->havingRaw('user_count > 1')
    ->get();
```