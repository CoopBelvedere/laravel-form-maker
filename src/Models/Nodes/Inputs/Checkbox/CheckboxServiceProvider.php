<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Checkbox;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Checkbox\CheckboxerContract;

class CheckboxServiceProvider extends ServiceProvider implements DeferrableProvider
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
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [CheckboxerContract::class];
    }
}
