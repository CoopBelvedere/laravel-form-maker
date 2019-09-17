<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Checkbox;

use Belvedere\FormMaker\Contracts\Inputs\Checkbox\CheckboxerContract;
use Illuminate\{
    Contracts\Support\DeferrableProvider,
    Support\ServiceProvider
};

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
