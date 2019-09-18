<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Range;

use Belvedere\FormMaker\{
    Contracts\Inputs\Range\RangerContract,
    Models\Nodes\Inputs\Input,
    Scopes\NodeScope
};

class Ranger extends Input implements RangerContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new NodeScope('range'));
    }

    /**
     * Ranger constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->addAvailableAttributes([
            'max',
            'min',
            'step',
        ]);
    }
}
