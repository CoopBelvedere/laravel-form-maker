<?php

namespace Belvedere\FormMaker\Models\Form\Inputs;

use Belvedere\FormMaker\Scopes\InputScope;
use Belvedere\FormMaker\Traits\{
    HasOptions,
    Properties\HasAutocomplete,
    Properties\HasMultiple,
    Properties\HasReadonly,
    Properties\HasRequired,
    Properties\HasSize
};

class Select extends Input
{
    use HasAutocomplete, HasMultiple, HasOptions, HasReadonly,
        HasRequired, HasSize;

    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        static::addGlobalScope(new InputScope('select'));

        parent::boot();
    }
}
