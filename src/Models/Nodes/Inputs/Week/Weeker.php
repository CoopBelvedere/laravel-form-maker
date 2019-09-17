<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Week;

use Belvedere\FormMaker\{
    Contracts\Inputs\Week\WeekerContract,
    Models\Nodes\Inputs\Input,
    Scopes\NodeScope
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

        static::addGlobalScope(new NodeScope('week'));
    }

    /**
     * Weeker constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setHtmlAttributesAttribute([
            'max',
            'min',
            'step',
        ]);
    }
}
