<?php

namespace A2way\LaravelTenantMigrate;

use \Illuminate\Console\Command as Command;
use \Illuminate\Database\QueryException as QueryException;
use \Symfony\Component\Console\Input\InputOption as InputOption;
use \Symfony\Component\Console\Input\InputArgument as InputArgument;

class MigrateAllTenantDatabasesCommand extends Command {
  protected $name = 'migrate:tenant:all';
  protected $description = 'Migrate all tenant databases.';

  public function handle(){
    $connectionName = $this->argument('connection-name');
		$databasePrefix = $this->argument('database-prefix');

    \DB::setDefaultConnection($connectionName);

    $tenantDbNames = $this -> getTenantDbNames($databasePrefix);

    foreach ($tenantDbNames as $tenantDbName) {
      try{
        $this -> call (
          'migrate:tenant:install',
          [
            'connection-name' => $connectionName,
            'database-name' => $tenantDbName,
          ]
        );
      } catch (QueryException $e){
        if($e -> getCode() != '42S01') {
          throw $e;
        }
        $this -> info ('Migration table already created.');
      }

      try {
        $this -> call(
          'migrate:tenant',
          [
            'connection-name' => $connectionName,
            'database-name' => $tenantDbName,
          ]
        );
      }catch(\Exception $e){
        echo $e -> getMessage().PHP_EOL;
      }

      $this -> info (PHP_EOL);
    }
  }

  protected function getArguments()
	{
		return array(
			array('connection-name', InputArgument::REQUIRED, 'Tenant connection name.'),
			array('database-prefix', InputArgument::REQUIRED, 'Tenant database name.'),
		);
	}

  private function getTenantDbNames($prefix){
    $prefixLength = strlen($prefix);

    $dbNames = \DB::select('show databases;');

    $tenantDbNames = [];

    foreach ($dbNames as $dbName) {
      $dbNameStart = substr($dbName -> Database, 0, $prefixLength);

      if($dbNameStart === $prefix) {
        $tenantDbNames[] = $dbName -> Database;
      }
    }

    return $tenantDbNames;
  }
}
