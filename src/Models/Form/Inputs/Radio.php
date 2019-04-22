<?php

namespace Belvedere\FormMaker\Models\Form\Inputs;

use Belvedere\FormMaker\Scopes\InputScope;
use Belvedere\FormMaker\Traits\Attributes\{
    HasChecked,
    HasRequired
};

class Radio extends Input
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

        static::addGlobalScope(new InputScope('radio'));
    }
}
