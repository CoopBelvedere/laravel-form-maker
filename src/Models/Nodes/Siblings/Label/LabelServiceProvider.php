<?php

namespace Belvedere\FormMaker\Models\Nodes\Siblings\Label;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Belvedere\FormMaker\Contracts\Models\Nodes\Siblings\Label\LabelerContract;

class LabelServiceProvider extends ServiceProvider implements DeferrableProvider
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
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [LabelerContract::class];
    }
}
