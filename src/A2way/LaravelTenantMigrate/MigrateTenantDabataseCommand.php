<?php
namespace A2way\LaravelTenantMigrate;

use Illuminate\Console\Command as Command;
use Symfony\Component\Console\Input\InputArgument as InputArgument;
use Symfony\Component\Console\Input\InputOption as InputOption;

class MigrateTenantDabataseCommand extends Command
{
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
    public function handle()
    {
        $connectionName = $this->argument('connection-name');
        $databaseName = $this->argument('database-name');

        \Config::set('database.connections.' . $connectionName . '.database', $databaseName);
        $connection = \DB::reconnect($connectionName);
        \DB::setDefaultConnection($connectionName);

        $this->info('Migrating tenant database "' . $databaseName . '"...');

        $this->call('migrate');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['connection-name', InputArgument::REQUIRED, 'Tenant connection name.'],
            ['database-name', InputArgument::REQUIRED, 'Tenant database name.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            //array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
        ];
    }
}
