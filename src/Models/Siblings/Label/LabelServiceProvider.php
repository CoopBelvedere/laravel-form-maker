<?php

namespace Belvedere\FormMaker\Models\Siblings\Label;

use Belvedere\FormMaker\Contracts\Siblings\Label\LabelerContract;
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
            $labeler = $app->config->get('form-maker.nodes.siblings.label', new Labeler());
            if (is_string($labeler)) {
                return new $labeler();
            }
            return $labeler;
        });

        $this->app->alias(LabelerContract::class, 'form-maker.label');
    }
}