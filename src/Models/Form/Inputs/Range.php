<?php

namespace Chess\FormMaker\Models\Form\Inputs;

use Chess\FormMaker\Scopes\InputScope;
use Chess\FormMaker\Traits\Properties\{
    HasAutocomplete,
    HasMinMax,
    HasRequired
};

class Range extends Input
{
    use HasAutocomplete, HasMinMax, HasRequired;

    /**
     * Additional rules for this input.
     *
     * @var array
     */
    public $additionalRules = [
        'html_properties.max' => 'required',
        'html_properties.min' => 'required',
    ];

    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new InputScope('range'));
    }
}
