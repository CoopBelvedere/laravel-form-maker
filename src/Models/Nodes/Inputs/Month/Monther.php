<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Month;

use Belvedere\FormMaker\{
    Contracts\Inputs\Month\MontherContract,
    Models\Nodes\Inputs\Input,
    Scopes\NodeScope
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

        static::addGlobalScope(new NodeScope('month'));
    }

    /**
     * Monther constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setHtmlAttributesAvailable([
            'max',
            'min',
            'step',
        ]);
    }
}
