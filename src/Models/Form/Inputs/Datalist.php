<?php

namespace Chess\FormMaker\Models\Form\Inputs;

use Chess\FormMaker\Scopes\InputScope;
use Chess\FormMaker\Traits\Properties\{
    HasReadonly,
    HasRequired
};

class Datalist extends Input
{
    use HasReadonly, HasRequired;

    /**
     * The properties automatically assigned on creation.
     *
     * @var array
     */
    public $assignedProperties = [
        'id'
    ];

    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new InputScope('datalist'));
    }
}
