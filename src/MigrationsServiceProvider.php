<?php

namespace Rareloop\Hatchet\Migrations;

use Rareloop\Hatchet\Hatchet;
use Rareloop\Hatchet\Migrations\Commands\Create;
use Rareloop\Hatchet\Migrations\Commands\Status;
use Rareloop\Hatchet\Migrations\Commands\Migrate;
use Rareloop\Hatchet\Migrations\Commands\SeedRun;
use Rareloop\Hatchet\Migrations\Commands\Rollback;
use Rareloop\Lumberjack\Providers\ServiceProvider;
use Rareloop\Hatchet\Migrations\Commands\SeedCreate;
use Rareloop\Hatchet\Migrations\Commands\CommandWrapper;
use Rareloop\Hatchet\Migrations\Commands\ProtectedCommandWrapper;

class MigrationsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->has(Hatchet::class) && $this->app->runningInConsole()) {
            $console = $this->app->get(Hatchet::class)->console();

            $console->add(new ProtectedCommandWrapper($this->app, new Migrate(), 'migrate'));
            $console->add(new ProtectedCommandWrapper($this->app, new Rollback(), 'migrate:rollback'));
            $console->add(new ProtectedCommandWrapper($this->app, new SeedRun(), 'db:seed'));
            $console->add(new CommandWrapper($this->app, new Create(), 'make:migration'));
            $console->add(new CommandWrapper($this->app, new Status(), 'migrate:status'));
            $console->add(new CommandWrapper($this->app, new SeedCreate(), 'make:seeder'));
        }
    }
}
