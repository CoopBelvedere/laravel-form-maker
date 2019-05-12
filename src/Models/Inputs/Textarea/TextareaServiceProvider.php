<?php

namespace Belvedere\FormMaker\Models\Inputs\Textarea;

use Belvedere\FormMaker\Contracts\Inputs\Textarea\TextareaerContract;

class TextareaServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(TextareaerContract::class, function ($app) {
            return $app->config->get('form-maker.nodes.inputs.textarea', new Textareaer());
        });

        $this->app->alias(TextareaerContract::class, 'form-maker.textarea');
    }
}