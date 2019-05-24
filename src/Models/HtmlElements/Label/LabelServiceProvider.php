<?php

namespace Belvedere\FormMaker\Models\HtmlElements\Label;

use Belvedere\FormMaker\Contracts\HtmlElements\Label\LabelerContract;
use Illuminate\Support\ServiceProvider;

class LabelServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(LabelerContract::class, function ($app) {
            $labeler = $app->config->get('form-maker.nodes.html_elements.label', new Labeler());
            if (is_string($labeler)) {
                return new $labeler();
            }
            return $labeler;
        });

        $this->app->alias(LabelerContract::class, 'form-maker.label');
    }
}