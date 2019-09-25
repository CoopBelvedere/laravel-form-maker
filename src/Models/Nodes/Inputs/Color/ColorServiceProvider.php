<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Color;

use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Color\ColorerContract;
use Illuminate\{
    Contracts\Support\DeferrableProvider,
    Support\ServiceProvider
};

class ColorServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(ColorerContract::class, function ($app) {
            $colorer = $app->config->get('form-maker.nodes.inputs.color', new Colorer());
            if (is_string($colorer)) {
                return new $colorer();
            }
            return $colorer;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [ColorerContract::class];
    }
}