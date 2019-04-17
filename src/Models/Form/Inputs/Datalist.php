<?php

namespace Belvedere\FormMaker\Models\Form\Inputs;

use Belvedere\FormMaker\Scopes\InputScope;
use Belvedere\FormMaker\Traits\Properties\{
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
