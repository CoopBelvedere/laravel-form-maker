<?php

namespace Belvedere\FormMaker\Models\Nodes\Siblings\Paragraph;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Belvedere\FormMaker\Contracts\Models\Nodes\Siblings\Paragraph\ParagrapherContract;

class ParagraphServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(ParagrapherContract::class, function ($app) {
            $paragrapher = $app->config->get('form-maker.nodes.siblings.paragraph', new Paragrapher());
            if (is_string($paragrapher)) {
                return new $paragrapher();
            }

            return $paragrapher;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [ParagrapherContract::class];
    }
}
