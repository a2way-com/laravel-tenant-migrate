<?php

namespace A2Way\LaravelTenantMigrate\Commands;

use A2Way\LaravelTenantMigrate\Helpers\DbHelper;
use Illuminate\Console\Command;

class SeedCommand extends Command
{
    protected $signature = '
        db:tenant:seed
        {connection : Connection name.}
        {database : Database name.}
        {--class : Seeder class name.}
    ';

    protected $description = '"db:seed" tenant database.';

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
        $className = $this->option('class');

        $this
            ->dbHelper
            ->changeConnectionDbAndSetAsDefault($connectionName, $databaseName)
        ;

        $this->info('Seeding database "' . $databaseName . '"...');
        $this->call('db:seed', [
            '--class' => $className,
        ]);
    }
}
