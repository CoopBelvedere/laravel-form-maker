<?php

namespace Belvedere\FormMaker\Models\Inputs\Checkbox;

use Belvedere\FormMaker\Contracts\Inputs\Checkbox\CheckboxerContract;
use Illuminate\Support\ServiceProvider;

class CheckboxServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(CheckboxerContract::class, function ($app) {
            return $app->config->get('form-maker.html.inputs.checkbox', new Checkboxer());
        });

        $this->app->alias(CheckboxerContract::class, 'form-maker.checkbox');
    }
}
