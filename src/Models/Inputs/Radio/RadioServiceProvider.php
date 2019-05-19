<?php

namespace Belvedere\FormMaker\Models\Inputs\Radio;

use Belvedere\FormMaker\Contracts\Inputs\Radio\RadioerContract;
use Illuminate\Support\ServiceProvider;

class RadioServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(RadioerContract::class, function ($app) {
            $radioer = $app->config->get('form-maker.nodes.inputs.radio', new Radioer());
            if (is_string($radioer)) {
                return new $radioer();
            }
            return $radioer;
        });

        $this->app->alias(RadioerContract::class, 'form-maker.radio');
    }
}