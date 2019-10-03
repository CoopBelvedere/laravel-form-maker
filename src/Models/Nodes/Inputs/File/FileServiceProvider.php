<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\File;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\File\FilerContract;

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
