<?php

namespace A2way\LaravelTenantMigrate;

use Illuminate\Support\ServiceProvider;

class LaravelTenantMigrateServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->app->bind('a2way::command.migrate.tenant.install', function($app){
			return new InstallTenantMigrationRepositoryCommand();
		});
		$this->app->bind('a2way::command.migrate.tenant', function($app){
			return new MigrateTenantDabataseCommand();
		});
		$this->app->bind('a2way::command.migrate.tenant.refresh', function($app){
			return new RefreshTenantDatabaseCommand();
		});
		$this->app->bind('a2way::command.migrate.tenant.reset', function($app){
			return new ResetTenantDatabaseCommand();
		});
		$this->app->bind('a2way::command.migrate.tenant.rollback', function($app){
			return new RollbackTenantDatabaseCommand();
		});
		$this->app->bind('a2way::command.db.tenant.seed', function($app){
			return new SeedTenantDatabaseCommand();
		});

		$this->commands([
			'a2way::command.migrate.tenant.install',
			'a2way::command.migrate.tenant',
			'a2way::command.migrate.tenant.refresh',
			'a2way::command.migrate.tenant.reset',
			'a2way::command.migrate.tenant.rollback',
			'a2way::command.db.tenant.seed'
		]);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
