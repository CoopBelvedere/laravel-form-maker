<?php

namespace Belvedere\FormMaker\Models\Inputs\Search;

use Belvedere\FormMaker\{
    Contracts\Inputs\Search\SearcherContract,
    Models\Inputs\Input,
    Scopes\ModelScope
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

        static::addGlobalScope(new ModelScope('search'));
    }

    /**
     * Searcher constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->htmlAttributesAvailable = array_merge($this->htmlAttributesAvailable, [
            'autocomplete',
            'maxlength',
            'minlength',
            'pattern',
            'placeholder',
            'readonly',
            'required',
            'size',
            'spellcheck',
        ]);
    }
}
