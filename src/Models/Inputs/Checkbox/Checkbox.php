<?php

namespace Belvedere\FormMaker\Models\Inputs;

use Belvedere\FormMaker\Scopes\InputScope;
use Belvedere\FormMaker\Traits\Attributes\{
    HasChecked,
    HasRequired
};

class Checkbox extends AbstractInput
{
    use HasChecked, HasRequired;

    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new InputScope('checkbox'));
    }
}
