<?php

namespace A2Way\LaravelTenantMigrate\Commands;

use A2Way\LaravelTenantMigrate\Helpers\DbHelper;
use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = '
        migrate:tenant:install
        {connection : Connection name.}
        {database : Database name.}
    ';

    protected $description = 'Create "migrations" table on tenant database.';

    private $dbHelper;

    public function __construct(DbHelper $dbHelper)
    {
        parent::__construct();

        $this->dbHelper = $dbHelper;
    }

    public function handle()
    {
        $connectionName = $this->argument('connection');
        $databaseName = $this->argument('database');

        $this
            ->dbHelper
            ->changeConnectionDbAndSetAsDefault($connectionName, $databaseName)
        ;

        $this->info('Creating migration table in tenant database "' . $databaseName . '"...');
        $this->call('migrate:install');
    }
}
