# Hatchet Migrations

## Installation

`composer require rareloop/hatchet-migrations`

Once installed, register the Service Provider in config/app.php:

```php
'providers' => [
    ...

    Rareloop\Hatchet\Migrations\MigrationsServiceProvider::class,

    ...
],
```

