<?php

namespace Belvedere\FormMaker\Models\Inputs\Week;

use Belvedere\FormMaker\Contracts\Inputs\Week\WeekerContract;
use Belvedere\FormMaker\Models\Inputs\AbstractInput;
use Belvedere\FormMaker\Scopes\InputScope;

class Weeker extends AbstractInput implements WeekerContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new InputScope('week'));
    }

    /**
     * Weeker constructor.
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
