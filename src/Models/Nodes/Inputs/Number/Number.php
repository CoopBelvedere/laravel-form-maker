<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Number;

use Belvedere\FormMaker\Scopes\NodeScope;
use Belvedere\FormMaker\Models\Nodes\Inputs\Input;
use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Number\NumberContract;

class Number extends Input implements NumberContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new NodeScope('number'));
    }

    /**
     * Number constructor.
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
