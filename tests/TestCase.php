<?php

namespace Belvedere\FormMaker\Tests;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();
    }

    /**
     * Set up the environment.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            'Belvedere\\FormMaker\\FormMakerServiceProvider',
            'Belvedere\\FormMaker\\Models\\Rankings\\RankingServiceProvider',
            'Belvedere\\FormMaker\\Models\\HtmlAttributes\\HtmlAttributeServiceProvider',
            'Belvedere\\FormMaker\\Models\\Rules\\RuleServiceProvider'
        ];
    }

    /**
     * Set up the database.
     */
    protected function setUpDatabase()
    {
        include_once __DIR__.'/../database/migrations/create_form_maker_tables.php.stub';

        (new \CreateFormMakerTables())->up();
    }

}