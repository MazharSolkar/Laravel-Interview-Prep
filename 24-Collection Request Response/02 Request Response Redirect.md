- [$request Object](#request-object)
    - [Handle Form](#handle-form)
      - [1. Accessing Input Data](#1-accessing-input-data)
      - [2. Retrieve all Input Data](#2-retrieve-all-input-data)
      - [3. Check Input Presence](#3-check-input-presence)
    - [Handle Files](#handle-files)
      - [1. Check if a specific file input filed exists in the request](#1-check-if-a-specific-file-input-filed-exists-in-the-request)
      - [2. Retrieve the uploaded file object for a specified field.](#2-retrieve-the-uploaded-file-object-for-a-specified-field)
    - [Check Request method](#check-request-method)
    - [Get URL of the Current Page](#get-url-of-the-current-page)
      - [1. without query parameters](#1-without-query-parameters)
      - [2. with query parameters](#2-with-query-parameters)
    - [Retrieve the client's IP address.](#retrieve-the-clients-ip-address)
- [$response Object](#response-object)
    - [1. Return Resposne](#1-return-resposne)
    - [2. response with status code.](#2-response-with-status-code)
    - [3. response with status code \& header](#3-response-with-status-code--header)
    - [4. json response](#4-json-response)
- [redirect method](#redirect-method)
    - [1. Redirect to unnamed route.](#1-redirect-to-unnamed-route)
    - [2. Redirect to unnamed route.](#2-redirect-to-unnamed-route)
    - [3. Redirect to thirdparty URL](#3-redirect-to-thirdparty-url)
    - [4. Redirect to previous page](#4-redirect-to-previous-page)
    - [5. Redirect with sesssion flash data.](#5-redirect-with-sesssion-flash-data)


# $request Object

**The Request object represents an HTTP request and provides methods for accessing data sent by the client. It includes data such as headers, cookies, form input data, query parameters, and more.**

### Handle Form

#### 1. Accessing Input Data

```php
$name = $request->input('name');
$email = $request->input('email', ''); // Default to empty string if email is missing
```

#### 2. Retrieve all Input Data

```php
$allData = $request->all();
```

#### 3. Check Input Presence

**`has($key)` Checks if a specific input field exists in the request (regardless of its value).**

```php
if ($request->has('name')) {
    // Process the name field
}
```

### Handle Files

#### 1. Check if a specific file input filed exists in the request

```php
if ($request->hasFile('avatar')) {
    // Process the uploaded avatar file
}
```

#### 2. Retrieve the uploaded file object for a specified field.

```php
$avatarFile = $request->file('avatar');
```

### Check Request method

**`method()` Returns the HTTP request method (GET, POST, PUT, etc.).**

```php
if ($request->method() === 'POST') {
    // Handle form submission
}
```

### Get URL of the Current Page

#### 1. without query parameters
```php
$currentUrl = $request->url();
```

#### 2. with query parameters
```php
$currentUrl = $request->fullUrl();
```

### Retrieve the client's IP address.

```php
$ipAddress = $request->ip();
```

# $response Object

**The Response object in Laravel allows you to control the HTTP response that your application sends back to the client. This includes the content of the response, HTTP status code, headers, cookies, and more.**

### 1. Return Resposne

```php
return response("Hello World");
```

### 2. response with status code.

```php
return response("Hello World", 200);
```

### 3. response with status code & header

```php
return response("Hello World", 200)
        ->('Content-Type', 'text/plain');
```

### 4. json response

```php
return response().json(['name'=>'mazhar', 'age'=>23]);
```

# redirect method

### 1. Redirect to unnamed route.

```php
return redirect('/home');
```

### 2. Redirect to unnamed route.

```php
return redirect()->route('tasks.home');
```

### 3. Redirect to thirdparty URL

```php
// http/https is compulsory to add
return redirect()->away('https://www.google.com');
```

### 4. Redirect to previous page

```php
return redirect()->back();
// or
return back();
```

### 5. Redirect with sesssion flash data.

```php
return redirect()->('tasks.home').with('status', 'task added successfully');
```