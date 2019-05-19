<?php

namespace Belvedere\FormMaker\Models\Inputs\Image;

use Belvedere\FormMaker\Contracts\Inputs\Image\ImagerContract;
use Illuminate\Support\ServiceProvider;

class ImageServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(ImagerContract::class, function ($app) {
            return $app->config->get('form-maker.nodes.inputs.image', new Imager());
        });

        $this->app->alias(ImagerContract::class, 'form-maker.image');
    }
}