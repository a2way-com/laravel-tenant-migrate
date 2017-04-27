<?php

namespace A2way\LaravelTenantMigrate;

use Illuminate\Config\Repository as Config;
use \Illuminate\Console\Command as Command;
use \Symfony\Component\Console\Input\InputOption as InputOption;
use \Symfony\Component\Console\Input\InputArgument as InputArgument;

class MigrateTenantDabataseCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'migrate:tenant';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$connectionName = $this->argument('connection-name');
		$databaseName = $this->argument('database-name');

        app(Config::class)->set('database.connections.'.$connectionName.'.database', $databaseName);
		$connection = \DB::reconnect($connectionName);
		\DB::setDefaultConnection($connectionName);

		$this->info('Migrating tenant database "'.$databaseName.'"...');

		$this->call('migrate');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('connection-name', InputArgument::REQUIRED, 'Tenant connection name.'),
			array('database-name', InputArgument::REQUIRED, 'Tenant database name.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			//array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
