<?php

namespace Tests;

use Orchestra\Testbench\TestCase as Orchestra;

use function Orchestra\Testbench\workbench_path;

abstract class TestCase extends Orchestra
{
    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom(workbench_path('database/migrations'));
    }

    protected function defineEnvironment($app)
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }
}
