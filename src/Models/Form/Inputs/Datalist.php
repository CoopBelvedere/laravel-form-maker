<?php

namespace Belvedere\FormMaker\Models\Form\Inputs;

use Belvedere\FormMaker\Scopes\InputScope;
use Belvedere\FormMaker\Traits\{
    HasOptions,
};

class Datalist extends Input
{
    use HasOptions;

    /**
     * The attributes automatically assigned on creation.
     *
     * @var array
     */
    public $assignedAttributes = [
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
