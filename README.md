#A2Way Laravel Tenant Migrate

#Upgrade

A2Way Laravel Tenant Migrate is a Laravel package that can be used to migrate different databases without editing database configuration files.

This is specially useful for SaaS (Software as a Service) web applications that stores data of each tenant in different databases. Migrating databases like that can be very hard because you might have to change your database configuration for each tenant database. As you can imagine, this is not a very scalable solution.

A2Way Laravel Tenant Migrate can help you overcome this problem.

##Commands Available

Installing A2Way Laravel Tenant Migrate on your Laravel project will add following commands to your artisan tool.

 - **migrate:tenant** (connection-name) (database-name)
 - **migrate:tenant:install** (connection-name) (database-name)
 - **migrate:tenant:refresh** (connection-name) (database-name)
 - **migrate:tenant:reset** (connection-name) (database-name)
 - **migrate:tenant:rollback** (connection-name) (database-name)

Each of above commands will perform the task of their cousin commands that has the similar name but for “tenant”. For an example, **migrate:tenant:refresh myConnection myDatabase** will run **migrate:refresh** on **myDatabase**, accessing it through connection details given in **myConnection**.

##Installing

1. Issue the following command:

    composer require dmgdwd/laravel-tenant-migrate 1.*

1. Then add the following line to your Laravel app’s “app/config/app.php” file’s “providers” sub-array.

    dmgdwd\LaravelTenantMigrate\LaravelTenantMigrateServiceProvider

1. Check the installation by issuing "php artisan command". If you are able to see the above commands in your list of commands, installation was successful.

##Contributing

Please read [http://a2way.com/contributing/](http://a2way.com/contributing/) before contributing.