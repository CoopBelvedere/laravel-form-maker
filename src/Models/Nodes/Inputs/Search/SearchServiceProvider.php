<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Search;

use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Search\SearcherContract;
use Illuminate\{
    Contracts\Support\DeferrableProvider,
    Support\ServiceProvider
};

class SearchServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(SearcherContract::class, function ($app) {
            $searcher = $app->config->get('form-maker.nodes.inputs.search', new Searcher());
            if (is_string($searcher)) {
                return new $searcher();
            }
            return $searcher;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [SearcherContract::class];
    }
}