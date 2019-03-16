<?php

namespace A2Way\LaravelTenantMigrate\Commands;

use A2Way\LaravelTenantMigrate\Helpers\DbHelper;
use Illuminate\Console\Command;

class RollbackCommand extends Command
{
    protected $signature = '
        migrate:tenant:rollback
        {connection : Connection name.}
        {database : Database name.}
    ';

    protected $description = '"migrate:rollback" tenant database.';

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

        $this->info('Rolling back database "' . $databaseName . '"...');
        $this->call('migrate:rollback');
    }
}
