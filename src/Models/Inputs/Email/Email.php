<?php

namespace Belvedere\FormMaker\Models\Inputs;

use Belvedere\FormMaker\Scopes\InputScope;
use Belvedere\FormMaker\Traits\Attributes\{
    HasAutocomplete,
    HasMinMaxLength,
    HasMultiple,
    HasPattern,
    HasPlaceholder,
    HasReadonly,
    HasRequired,
    HasSize
};

class Email extends AbstractInput
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
