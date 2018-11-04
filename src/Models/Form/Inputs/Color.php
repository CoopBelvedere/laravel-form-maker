<?php

namespace Chess\FormMaker\Models\Form\Inputs;

use Chess\FormMaker\Scopes\InputScope;
use Chess\FormMaker\Traits\Properties\{
    HasAutocomplete,
    HasRequired
};

class Color extends Input
{
    use HasAutocomplete, HasRequired;

    /**
     * Additional rules for this input.
     *
     * @var array
     */
    public $additionalRules = [
        'html_properties.value' => 'required',
    ];

    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new InputScope('color'));
    }
}
