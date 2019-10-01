<?php

namespace Belvedere\FormMaker\Tests;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            'Belvedere\\FormMaker\\FormMakerServiceProvider',
            'Belvedere\\FormMaker\\Models\\HtmlAttributes\\HtmlAttributeServiceProvider',
        ];
    }
}