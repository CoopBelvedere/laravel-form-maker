<?php

namespace Chess\FormMaker\Models\Form\Inputs;

use Chess\FormMaker\Scopes\InputScope;
use Chess\FormMaker\Traits\Properties\{
    HasAutocomplete,
    HasMinMaxLength,
    HasPattern,
    HasPlaceholder,
    HasReadonly,
    HasRequired,
    HasSize,
    HasSpellcheck
};

class Search extends Input
{
    use HasAutocomplete, HasMinMaxLength, HasPattern, HasPlaceholder,
        HasReadonly, HasRequired, HasSize, HasSpellcheck;

    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new InputScope('search'));
    }
}
