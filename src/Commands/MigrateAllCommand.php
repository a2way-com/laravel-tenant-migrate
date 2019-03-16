<?php

namespace A2Way\LaravelTenantMigrate\Commands;

use A2Way\LaravelTenantMigrate\Helpers\DbHelper;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\QueryException;

class MigrateAllCommand extends Command
{
    protected $signature = '
        migrate:tenant:all
        {connection : Connection name.}
        {database-prefix : Database prefix.}
    ';

    protected $description = '"migrate" all tenant databases.';

    private $db;
    private $dbHelper;

    public function __construct(
        DatabaseManager $db,
        DbHelper $dbHelper
    ) {
        parent::__construct();

        $this->db = $db;
        $this->dbHelper = $dbHelper;
    }

    public function handle()
    {
        $connectionName = $this->argument('connection');
        $databasePrefix = $this->argument('database-prefix');

        $tenantDbNames = $this -> getTenantDbNames($databasePrefix);

        foreach ($tenantDbNames as $tenantDbName) {
            try {
                $this -> call(
                    'migrate:tenant:install',
                    [
                        'connection' => $connectionName,
                        'database' => $tenantDbName,
                    ]
                );
            } catch (QueryException $e) {
                if ($e -> getCode() != '42S01') {
                    throw $e;
                }
                $this -> info('Migration table already created.');
            }

            try {
                $this -> call(
                    'migrate:tenant',
                    [
                        'connection' => $connectionName,
                        'database' => $tenantDbName,
                    ]
                );
            } catch (Exception $e) {
                echo $e -> getMessage() . PHP_EOL;
            }
            $this -> info(PHP_EOL);
        }
    }

    private function getTenantDbNames(string $dbPrefix): array
    {
        $prefixLength = strlen($dbPrefix);

        $dbNames = $this
            ->db
            ->select('show databases;')
        ;

        $tenantDbNames = [];

        foreach ($dbNames as $dbName) {
            $dbNameStart = substr($dbName -> Database, 0, $prefixLength);
            if ($dbNameStart === $dbPrefix) {
                $tenantDbNames[] = $dbName -> Database;
            }
        }

        return $tenantDbNames;
    }
}
