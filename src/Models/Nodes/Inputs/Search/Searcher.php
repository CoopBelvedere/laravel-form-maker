<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Search;

use Belvedere\FormMaker\{
    Contracts\Models\Nodes\Inputs\Search\SearcherContract,
    Models\Nodes\Inputs\Input,
    Scopes\NodeScope
};

class Searcher extends Input implements SearcherContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new NodeScope('search'));
    }

    /**
     * Searcher constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->addAvailableAttributes([
            'maxlength',
            'minlength',
            'pattern',
            'placeholder',
            'size',
            'spellcheck',
        ]);
    }
}
