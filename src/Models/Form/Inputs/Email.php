<?php

namespace Chess\FormMaker\Models\Form\Inputs;

use Chess\FormMaker\Scopes\InputScope;
use Chess\FormMaker\Traits\Properties\{
    HasAutocomplete,
    HasMinMaxLength,
    HasMultiple,
    HasPattern,
    HasPlaceholder,
    HasReadonly,
    HasRequired,
    HasSize
};

class Email extends Input
{
    use HasAutocomplete, HasMinMaxLength, HasMultiple, HasPattern,
        HasPlaceholder, HasReadonly, HasRequired, HasSize;

    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new InputScope('email'));
    }
}
