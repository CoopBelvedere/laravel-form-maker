<?php

namespace Belvedere\FormMaker\Models\Inputs\Tel;

use Belvedere\FormMaker\Contracts\Inputs\Tel\TelerContract;
use Belvedere\FormMaker\Models\Inputs\Input;
use Belvedere\FormMaker\Scopes\ModelScope;

class Teler extends Input implements TelerContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ModelScope('tel'));
    }

    /**
     * Teler constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->htmlAttributesAvailable = array_merge($this->htmlAttributesAvailable, [
            'autocomplete',
            'maxlength',
            'minlength',
            'pattern',
            'placeholder',
            'readonly',
            'required',
            'size',
        ]);
    }
}
