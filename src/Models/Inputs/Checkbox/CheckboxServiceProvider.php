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
        $this->app->bind(CheckboxerContract::class, function ($app) {
            $checkboxer = $app->config->get('form-maker.nodes.inputs.checkbox', new Checkboxer());
            if (is_string($checkboxer)) {
                return new $checkboxer();
            }
            return $checkboxer;
        });

        $this->app->alias(CheckboxerContract::class, 'form-maker.checkbox');
    }
}
