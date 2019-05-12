<?php

namespace Belvedere\FormMaker\Models\Inputs\Range;

use Belvedere\FormMaker\Contracts\Inputs\Range\RangerContract;
use Belvedere\FormMaker\Models\Inputs\AbstractInput;
use Belvedere\FormMaker\Scopes\InputScope;

class Ranger extends AbstractInput implements RangerContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new InputScope('range'));
    }

    /**
     * Ranger constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->attributesAvailable = array_merge($this->attributesAvailable, [
            'autocomplete',
            'max',
            'min',
            'required',
            'step',
        ]);
    }
}
