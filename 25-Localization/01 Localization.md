- [Localization](#localization)
- [Setting Up Localization](#setting-up-localization)
    - [1. Create Language Files](#1-create-language-files)
    - [2. Accessing Translation Strings](#2-accessing-translation-strings)
    - [3. Set Language](#3-set-language)
      - [Default Language](#default-language)
    - [Set Language Dynamically](#set-language-dynamically)
    - [4. Fallback Language](#4-fallback-language)
- [Pluralization](#pluralization)
    - [Example](#example)
    - [Usage](#usage)
- [Placeholders](#placeholders)
    - [Example](#example-1)
    - [Usage](#usage-1)


# Localization

Localization in Laravel provides a way to manage translations and support multiple languages in your application. This feature is essential for creating applications that can be used in different regions with varying languages.

https://www.youtube.com/watch?v=RAp_Qf5_6eI

https://5balloons.info/localization-laravel-multi-language-language-switcher

# Setting Up Localization

### 1. Create Language Files
Language files are stored in the `lang` directory. Each language has its own subdirectory.

`example`
```bash
  lang
    ├── en
    │   └── home.php
    ├── es
    │   └── home.php
```

`en/home.php`
```php
return [
  'page' => 'Home Page',
  'home' => 'Home',
  'about' => 'About',
  'contact' => 'Contact',
  'welcome' => 'Welcome :name'
];
```

`hi/home.php`
```php
return [
  'page' => 'मुख पृष्ठ',
  'home' => 'घर',
  'about' => 'के बारे में',
  'contact' => 'संपर्क',
  'welcome' => 'स्वागत है :name'
];
```

### 2. Accessing Translation Strings
**You can retrieve translation strings using the `__` helper function or the `@lang` Blade directive.**

`home.blade.php`
```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="dropdown my-4">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Select Language
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="locale/en">English</a></li>
            <li><a class="dropdown-item" href="locale/hi">Hindi</a></li>
        </ul>
    </div>

    <h1>{{ __('home.page') }}</h1>
    <ul>
        <li>{{ __('home.home') }}</li>
        <li>{{ __('home.about') }}</li>
        <li>{{ __('home.contact') }}</li>
    </ul>

    <h1>{{ __('home.welcome', ['name' => 'Mazhar']) }}</h1>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
```

### 3. Set Language

#### Default Language
Set the default locale in the `config/app.php` file.

```php
'locale' => 'en',
```

### Set Language Dynamically
Set the locale dynamically in your application.

```php
App::setLocale('hi'); // Set the locale to hindi
```

### 4. Fallback Language
Set a fallback locale in case a translation is not available for the current locale.

```php
'fallback_locale' => 'en',
```

# Pluralization

Laravel supports pluralization for translations using placeholders. This feature allows you to define different translations based on the quantity of items.

### Example
`lang/en/message.php`
```php
return [
    'apples' => 'There is one apple|There are many apples',
];
```

### Usage
```php
echo trans_choice('messages.apples', 1); // Outputs: There is one apple
echo trans_choice('messages.apples', 5); // Outputs: There are many apples
```

# Placeholders
You can replace placeholders in your translations with dynamic values.

### Example
`lang/en/message.php`
```php
return [
    'greeting' => 'Hello, :name!',
];
```

### Usage
```php
echo __('messages.greeting', ['name' => 'John']); // Outputs: Hello, John!
```