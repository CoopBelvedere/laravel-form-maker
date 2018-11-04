<?php

namespace Chess\FormMaker\Models\Form\Inputs;

use Chess\FormMaker\Scopes\InputScope;
use Chess\FormMaker\Traits\Properties\{
    HasChecked,
    HasRequired
};

class Radio extends Input
{
    use HasChecked, HasRequired;

    /**
     * Additional rules for this input.
     *
     * @var array
     */
    public $additionalRules = [
        'html_properties.name' => 'required',
        'html_properties.title' => 'required',
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

        static::addGlobalScope(new InputScope('radio'));
    }
}
