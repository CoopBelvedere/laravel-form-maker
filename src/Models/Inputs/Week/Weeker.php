<?php

namespace Belvedere\FormMaker\Models\Inputs\Week;

use Belvedere\FormMaker\{
    Contracts\Inputs\Week\WeekerContract,
    Models\Inputs\Input,
    Scopes\ModelScope
};

class Weeker extends Input implements WeekerContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ModelScope('week'));
    }

    /**
     * Weeker constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->htmlAttributesAvailable = array_merge($this->htmlAttributesAvailable, [
            'max',
            'min',
            'readonly',
            'required',
            'step',
        ]);
    }
}
