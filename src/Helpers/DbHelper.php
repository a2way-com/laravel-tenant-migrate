<?php

namespace A2Way\LaravelTenantMigrate\Helpers;

use Illuminate\Config\Repository as Config;
use Illuminate\Database\DatabaseManager;

class DbHelper
{
    private $db;
    private $config;

    public function __construct(
        DatabaseManager $db,
        Config $config
    ) {
        $this->db = $db;
        $this->config = $config;
    }

    public function changeConnectionDbAndSetAsDefault(string $connectionName, string $dbName)
    {
        $this
            ->db
            ->purge($connectionName)
        ;

        $this
            ->config
            ->set('database.connections.' . $connectionName . '.database', $dbName)
        ;

        $connection = $this
            ->db
            ->reconnect($connectionName)
        ;

        $this
            ->db
            ->setDefaultConnection($connectionName)
        ;
    }
}
