<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Text;

use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Text\TexterContract;
use Illuminate\{
    Contracts\Support\DeferrableProvider,
    Support\ServiceProvider
};

class TextServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(TexterContract::class, function ($app) {
            $texter = $app->config->get('form-maker.nodes.inputs.text', new Texter());
            if (is_string($texter)) {
                return new $texter();
            }
            return $texter;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [TexterContract::class];
    }
}