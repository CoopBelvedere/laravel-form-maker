<?php

namespace Belvedere\FormMaker\Models\Inputs\Month;

use Belvedere\FormMaker\{
    Contracts\Inputs\Month\MontherContract,
    Models\Inputs\Input,
    Scopes\ModelScope
};

class Monther extends Input implements MontherContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ModelScope('month'));
    }

    /**
     * Monther constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->htmlAttributesAvailable = array_merge($this->htmlAttributesAvailable, [
            'max',
            'min',
            'step',
        ]);
    }
}
