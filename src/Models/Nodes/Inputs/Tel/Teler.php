<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Tel;

use Belvedere\FormMaker\{
    Contracts\Models\Nodes\Inputs\Tel\TelerContract,
    Models\Nodes\Inputs\Input,
    Scopes\NodeScope
};

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

        static::addGlobalScope(new NodeScope('tel'));
    }

    /**
     * Teler constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->addAvailableAttributes([
            'maxlength',
            'minlength',
            'pattern',
            'placeholder',
            'size',
        ]);
    }
}
