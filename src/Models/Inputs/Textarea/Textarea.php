<?php

namespace Belvedere\FormMaker\Models\Inputs;

use Belvedere\FormMaker\Scopes\InputScope;
use Belvedere\FormMaker\Traits\Attributes\{
    HasAutofocus,
    HasReadonly,
    HasRequired,
    HasSpellcheck
};

class Textarea extends AbstractInput
{
    use HasAutofocus, HasReadonly, HasRequired, HasSpellcheck;

    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new InputScope('textarea'));
    }
}
