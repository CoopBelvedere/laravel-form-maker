<?php

namespace Belvedere\FormMaker\Models\Inputs\File;

use Belvedere\FormMaker\Contracts\Inputs\File\FilerContract;
use Illuminate\{
    Contracts\Support\DeferrableProvider,
    Support\ServiceProvider
};

class FileServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(FilerContract::class, function ($app) {
            $filer = $app->config->get('form-maker.nodes.inputs.file', new Filer());
            if (is_string($filer)) {
                return new $filer();
            }
            return $filer;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [FilerContract::class];
    }
}