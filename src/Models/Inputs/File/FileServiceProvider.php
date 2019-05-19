<?php

namespace Belvedere\FormMaker\Models\Inputs\File;

use Belvedere\FormMaker\Contracts\Inputs\File\FilerContract;
use Illuminate\Support\ServiceProvider;

class FileServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(FilerContract::class, function ($app) {
            return $app->config->get('form-maker.nodes.inputs.file', new Filer());
        });

        $this->app->alias(FilerContract::class, 'form-maker.file');
    }
}