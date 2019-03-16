<?php

namespace A2Way\LaravelTenantMigrate\Commands;

use A2Way\LaravelTenantMigrate\Helpers\DbHelper;
use Illuminate\Console\Command;

class MigrateCommand extends Command
{
    protected $signature = '
        migrate:tenant
        {connection : Connection name.}
        {database : Database name.}
    ';

    protected $description = '"migrate" tenant database.';

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

        $this->info('Migrating tenant database "' . $databaseName . '"...');
        $this->call('migrate');
    }
}
