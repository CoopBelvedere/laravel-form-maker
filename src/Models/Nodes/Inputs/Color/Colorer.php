<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Color;

use Belvedere\FormMaker\{
    Contracts\Inputs\Color\ColorerContract,
    Models\Nodes\Inputs\Input,
    Scopes\NodeScope
};

class Colorer extends Input implements ColorerContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new NodeScope('color'));
    }
}
