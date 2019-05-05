<?php


namespace Belvedere\FormMaker\Models\Inputs\Color;

use Belvedere\FormMaker\Contracts\HtmlAttributes\HtmlAttributerContract;
use Belvedere\FormMaker\Contracts\Inputs\Checkbox\CheckboxerContract;
use Belvedere\FormMaker\Models\Inputs\Checkbox\Checkboxer;

class ColorServiceProvider
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

        $this->app->alias(HtmlAttributerContract::class, 'form-maker.checkbox');
    }
}