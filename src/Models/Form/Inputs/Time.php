<?php

namespace Belvedere\FormMaker\Models\Form\Inputs;

use Belvedere\FormMaker\Scopes\InputScope;
use Belvedere\FormMaker\Traits\Attributes\{
    HasMinMax,
    HasReadonly,
    HasRequired
};

class Time extends Input
{
    use HasMinMax, HasReadonly, HasRequired;

    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new InputScope('time'));
    }
}
