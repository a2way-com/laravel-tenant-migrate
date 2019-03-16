<?php

namespace A2Way\LaravelTenantMigrate;

use A2Way\LaravelTenantMigrate\Commands\InstallCommand;
use A2Way\LaravelTenantMigrate\Commands\MigrateAllCommand;
use A2Way\LaravelTenantMigrate\Commands\MigrateCommand;
use A2Way\LaravelTenantMigrate\Commands\RefreshCommand;
use A2Way\LaravelTenantMigrate\Commands\ResetCommand;
use A2Way\LaravelTenantMigrate\Commands\RollbackCommand;
use A2Way\LaravelTenantMigrate\Commands\SeedCommand;
use Illuminate\Support\ServiceProvider;

class A2WayLaravelTenantMigrateServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands([
            InstallCommand::class,
            MigrateAllCommand::class,
            MigrateCommand::class,
            RefreshCommand::class,
            ResetCommand::class,
            RollbackCommand::class,
            SeedCommand::class,
        ]);
    }
}
