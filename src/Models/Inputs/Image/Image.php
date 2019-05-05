<?php

namespace Belvedere\FormMaker\Models\Inputs;

use Belvedere\FormMaker\Scopes\InputScope;
use Belvedere\FormMaker\Traits\Attributes\HasReadonly;

class Image extends AbstractInput
{
    use HasReadonly;

    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        static::addGlobalScope(new InputScope('image'));

        parent::boot();
    }
}
