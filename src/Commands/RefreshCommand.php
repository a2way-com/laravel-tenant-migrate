<?php

namespace A2Way\LaravelTenantMigrate\Commands;

use A2Way\LaravelTenantMigrate\Helpers\DbHelper;
use Illuminate\Console\Command;

class RefreshCommand extends Command
{
    protected $signature = '
        migrate:tenant:refresh
        {connection : Connection name.}
        {database : Database name.}
    ';

    protected $description = '"migrate:refresh" tenant database.';

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

        $this->info('Refreshing database "' . $databaseName . '"...');
        $this->call('migrate:refresh');
    }
}
