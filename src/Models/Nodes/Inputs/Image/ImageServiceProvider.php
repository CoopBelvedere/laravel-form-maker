<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Image;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Image\ImagerContract;

class ImageServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(ImagerContract::class, function ($app) {
            $imager = $app->config->get('form-maker.nodes.inputs.image', new Imager());
            if (is_string($imager)) {
                return new $imager();
            }

            return $imager;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [ImagerContract::class];
    }
}
