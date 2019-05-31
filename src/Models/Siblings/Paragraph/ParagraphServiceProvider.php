<?php

namespace Belvedere\FormMaker\Models\Siblings\Paragraph;

use Belvedere\FormMaker\Contracts\Siblings\Paragraph\ParagrapherContract;
use Illuminate\Support\ServiceProvider;

class ParagraphServiceProvider extends ServiceProvider
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

        $this->app->alias(ParagrapherContract::class, 'form-maker.paragraph');
    }
}