# Laravel Migrations Generator

Generate Laravel Migrations from an existing database, including indexes and foreign keys!

## Laravel 5 installation

The recommended way to install this is through composer:

```bash
composer require --dev "spacegrass/laravel-migrations-generator"
```

In Laravel 5.5 the service providers will automatically get registered. 

In older versions of the framework edit `config/app.php` and add this to providers section:

```php
Way\Generators\GeneratorsServiceProvider::class,
Spacegrass\MigrationsGenerator\MigrationsGeneratorServiceProvider::class,
```
If you want this lib only for dev, you can add the following code to your `app/Providers/AppServiceProvider.php` file, within the `register()` method:

```php
public function register()
{
    if ($this->app->environment() !== 'production') {
        $this->app->register(\Way\Generators\GeneratorsServiceProvider::class);
        $this->app->register(\Spacegrass\MigrationsGenerator\MigrationsGeneratorServiceProvider::class);
    }
    // ...
}
```

## Usage

To generate migrations from a database, you need to have your database setup in Laravel's Config.

Run `php artisan migrate:generate` to create migrations for all the tables, or you can specify the tables you wish to generate using `php artisan migrate:generate table1,table2,table3,table4,table5`. You can also ignore tables with `--ignore="table3,table4,table5"`

Laravel Migrations Generator will first generate all the tables, columns and indexes, and afterwards setup all the foreign key constraints. So make sure you include all the tables listed in the foreign keys so that they are present when the foreign keys are created.

You can also specify the connection name if you are not using your default connection with `--connection="connection_name"`

Run `php artisan help migrate:generate` for a list of options.

The Laravel Migrations Generator is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

## Testing

To run tests, create a new laravel project locally, ie `laravel new test-migrations-generator`

in the root directory, run `git submodule add https://github.com/dallincoons/laravel-migrations-generator.git package` which will install the package into a direvtory called `package`

in the root directories composer.json file, add

```json
"repositories": [
        {
            "type": "path",
            "url": "./package"
        }
    ]
```

and then run `composer require spacegrass/laravel-migrations-generator @dev`

now in config/app.php, add the providers:

```php
Way\Generators\GeneratorsServiceProvider::class,
Spacegrass\MigrationsGenerator\MigrationsGeneratorServiceProvider::class,
```

navigate into the `package` directory, composer install, and now you should be able to run the tests: `vendor/bin/phpunit`
