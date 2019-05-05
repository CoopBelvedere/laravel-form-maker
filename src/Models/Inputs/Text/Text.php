<?php

namespace Belvedere\FormMaker\Models\Inputs;

use Belvedere\FormMaker\Scopes\InputScope;
use Belvedere\FormMaker\Traits\Attributes\{
    HasAutocomplete,
    HasAutofocus,
    HasMinMaxLength,
    HasPattern,
    HasPlaceholder,
    HasReadonly,
    HasRequired,
    HasSize,
    HasSpellcheck
};

class Text extends AbstractInput
{
    use HasAutocomplete, HasAutofocus, HasMinMaxLength, HasPattern,
        HasPlaceholder, HasReadonly, HasRequired, HasSize, HasSpellcheck;

    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new InputScope('text'));
    }
}
