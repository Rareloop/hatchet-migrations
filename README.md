# Hatchet Migrations

Provides a wrapper around the [Phinx Database Migrations](https://phinx.org/) package that integrates with Hatchet & Lumberjack.

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

Copy the example `config/migrations.php` file to you theme directory _(optional)_.

Make sure you create the needed folders for your migrations and seeds. If you don't change the default config then these will be:

- `{theme}/database/migrations`
- `{theme}/database/seeds`

## Usage

This package makes the following commands are available to you:

| Hatchet Command | Description | Related Phinx Documentation |
| :--- | :--- | :--- |
| `make:migration` | Create a new migration file | [phinx create](https://book.cakephp.org/phinx/0/en/migrations.html#creating-a-new-migration) |
| `migrate`  |Run migration(s) | [phinx migrate](https://book.cakephp.org/phinx/0/en/commands.html#the-migrate-command) |
| `migrate:rollback` | Rollback migration(s) | [phinx rollback](https://book.cakephp.org/phinx/0/en/commands.html#the-rollback-command) |
| `migrate:status` | Output the current status on which migrations have been run | [phinx status](https://book.cakephp.org/phinx/0/en/commands.html#the-status-command) |
| `make:seeder` | Create a Database Seeder | [phinx seed:create](https://book.cakephp.org/phinx/0/en/seeding.html) |
| `db:seed` | Run seed(s) | [phinx seed:run](https://book.cakephp.org/phinx/0/en/commands.html#the-seed-run-command) |

For usage information on each command either consult the associated Phinx documentation or use the hatchet CLI:

`php hatchet help {command}`
