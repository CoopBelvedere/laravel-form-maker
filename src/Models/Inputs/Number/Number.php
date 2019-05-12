<?php

namespace Belvedere\FormMaker\Models\Inputs\Number;

use Belvedere\FormMaker\Contracts\Inputs\Number\NumberContract;
use Belvedere\FormMaker\Models\Inputs\AbstractInput;
use Belvedere\FormMaker\Scopes\InputScope;

class Number extends AbstractInput implements NumberContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new InputScope('number'));
    }

    /**
     * Number constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->attributesAvailable = array_merge($this->attributesAvailable, [
            'max',
            'min',
            'readonly',
            'required',
            'step',
        ]);
    }
}