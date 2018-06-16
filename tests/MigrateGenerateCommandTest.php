<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Spacegrass\Tests\TestCase;
use Symfony\Component\Filesystem\Filesystem;

class MigrateGenerateCommandTest extends TestCase
{
    /** @test */
    public function heyi()
    {
        (new Filesystem())->remove(__DIR__ . '/../../database/migrations');
        (new Filesystem())->mkdir(__DIR__ . '/../../database/migrations');
        $this->artisan('migrate:refresh', ['--path' => 'package/tests/fixtures/migrations']);
        $this->artisan('migrate:generate', ['--no-interaction' => true]);

        $file = glob(__DIR__ . '/../../database/migrations/*create_some_table_table.php');

        $this->assertCount(1, $file);
    }
}
